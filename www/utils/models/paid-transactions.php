<?php

class PaidTransaction extends DBConnection
 {

    public function getPaidTransactions()
 {
        $sql = $this->connect()->prepare( 'SELECT barcode FROM receipt' );
        $sql->execute();

        $any = $sql->fetchAll( PDO::FETCH_ASSOC );
        echo json_encode( [
            'success' => true,
            'barCode' => $any
        ] );
    }

    public function transactions( $barcodes )
 {
        // Prepare the first query to fetch transactions.
        $sql = $this->connect()->prepare( "SELECT
        t.prod_id AS productId,
        MAX(t.receipt_id) AS receiptId,
        t.transaction_num AS transaction_num,
        MAX(t.payment_id) AS paymentId, 
        MAX(u.first_name) AS firstname, 
        MAX(u.last_name) AS lastname,
        p.id AS code,
        receipt.barcode as invoiceNumber,
        SUM(t.prod_qty) AS qty, -- Total purchased quantities
        p.prod_desc AS description,
        (SUM(t.prod_qty) - COALESCE(r.total_refunded_qty, 0) - COALESCE(re.total_return_qty, 0)) AS net_qty, -- Corrected net quantity
        AVG(p.prod_price) AS avg_price,
        (SUM(t.prod_qty) - COALESCE(r.total_refunded_qty, 0) - COALESCE(re.total_return_qty, 0)) * AVG(p.prod_price) AS total_amount
    FROM
        transactions t
        INNER JOIN receipt ON receipt.id = t.receipt_id
        INNER JOIN products p ON p.id = t.prod_id
        INNER JOIN users u ON u.id = t.user_id
        LEFT JOIN (
            SELECT
                refunded.prod_id,
                refunded.payment_id,
                SUM(refunded.refunded_qty) AS total_refunded_qty
            FROM
                refunded
            GROUP BY
                refunded.prod_id, refunded.payment_id
        ) r ON r.prod_id = t.prod_id AND r.payment_id = t.payment_id
        LEFT JOIN (
            SELECT
                return_exchange.product_id,
                return_exchange.payment_id,
                SUM(return_exchange.return_qty) AS total_return_qty
            FROM
                return_exchange
            GROUP BY
                return_exchange.product_id, return_exchange.payment_id
        ) re ON re.product_id = t.prod_id AND re.payment_id = t.payment_id
    WHERE
        receipt.barcode = :barcode
        AND t.is_paid = 1
        AND t.prod_qty > 0
    GROUP BY
        t.prod_id, t.transaction_num
    HAVING
        net_qty > 0
    
    " );
        $sql->bindParam( ':barcode', $barcodes );
        $sql->execute();
        $transac = $sql->fetchAll( PDO::FETCH_ASSOC );

        // Check if transactions are found
        if ( empty( $transac ) ) {
            return [
                'success' => false,
                'message' => 'No transactions found for the given barcode.'
            ];
        }

        $firstTransaction = $transac[ 0 ];

        $latestRefSql = $this->connect()->prepare( "
            SELECT MAX(reference_num) AS latest_reference_number
            FROM refunded
            WHERE payment_id = :payment_id
        " );
        // Corrected: Binding parameters using the first transaction's data
      
        $latestRefSql->bindParam(':payment_id', $firstTransaction['paymentId']);
        $latestRefSql->execute();
        $latestReference = $latestRefSql->fetch(PDO::FETCH_ASSOC);
    
            // Count the number of refunds for each transaction
            $countRefundsSql = $this->connect()->prepare("
            SELECT
            COUNT(DISTINCT reference_num) AS refund_count
          FROM
            refunded
          WHERE
          payment_id = :payment_id;
            
        ");
        $countRefundsSql->bindParam(':payment_id', $firstTransaction['paymentId']);
        $countRefundsSql->execute();
        $refundCounts = $countRefundsSql->fetchAll(PDO::FETCH_ASSOC);

        $countRetEx = $this->connect()->prepare('SELECT COUNT(*) as retex FROM `return_exchange` WHERE payment_id = :payment_id');
        $countRetEx->bindParam(':payment_id', $firstTransaction['paymentId']);
        $countRetEx->execute();
        $returnCounts =  $countRetEx->fetchAll(PDO::FETCH_ASSOC);
        return [
            'success' => true,
            'transac' => $transac,
            'latest_reference_number' =>  $latestReference['latest_reference_number'],
            'refundCounts' =>   $refundCounts,
            'returnCount' =>  $returnCounts 
        ];
    }
            
    public function processRefund( $prod_qty, $prod_id, $payment_id, $product_price,$method,$otherDetails) {

        $deductAmount = $prod_qty * $product_price;
        $updateSql = $this->connect()->prepare( 'UPDATE inventory SET stock = stock + :prod_qty, sold = sold - :prod_qty WHERE product_id = :prod_id' );
        $updateSql->bindParam( ':prod_qty', $prod_qty, PDO::PARAM_INT );
        $updateSql->bindParam( ':prod_id', $prod_id, PDO::PARAM_INT );
        $updateSql->execute();

        $checkTodaySql = $this->connect()->prepare("SELECT reference_num FROM refunded WHERE date = NOW() ORDER BY reference_num DESC LIMIT 1");
        $checkTodaySql->execute();
        $todayResult = $checkTodaySql->fetch(PDO::FETCH_ASSOC);

        $reference_num = null;

        if ($todayResult) {
            $reference_num = $todayResult['reference_num']; 
        } else {
            $maxRefSql = $this->connect()->prepare("SELECT MAX(reference_num) AS max_ref FROM refunded WHERE date != NOW()");
            $maxRefSql->execute();
            $maxRefResult = $maxRefSql->fetch(PDO::FETCH_ASSOC);
            $nextRefNum = $maxRefResult ? (int)$maxRefResult['max_ref'] + 1 : 1;
            $reference_num = sprintf('%08d', $nextRefNum);
        }

        $insertSql = $this->connect()->prepare('INSERT INTO refunded ( prod_id, payment_id, refunded_qty, date, reference_num, refunded_amt,refunded_method_id,otherDetails)
                VALUES ( :prod_id, :payment_id, :refunded_qty, NOW(), :reference_num, :deductAmount,:method,:otherDetails)');

        $insertSql->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
        $insertSql->bindParam(':payment_id', $payment_id, PDO::PARAM_INT);
        $insertSql->bindParam(':refunded_qty', $prod_qty, PDO::PARAM_INT);
        $insertSql->bindParam(':reference_num', $reference_num, PDO::PARAM_STR);
        $insertSql->bindParam(':deductAmount', $deductAmount, PDO::PARAM_INT);
        $insertSql->bindParam(':method', $method, PDO::PARAM_INT);//$otherDetail
        $insertSql->bindParam(':otherDetails', $otherDetails);
        $insertSql->execute();


        $fetchReceiptIdSql = $this->connect()->prepare( 'SELECT receipt_id FROM transactions WHERE payment_id = :payment_id ORDER BY id ASC LIMIT 1' );
        $fetchReceiptIdSql->bindParam( ':payment_id', $payment_id, PDO::PARAM_INT );
        $fetchReceiptIdSql->execute();
        $receiptResult = $fetchReceiptIdSql->fetch( PDO::FETCH_ASSOC );

        if ( !$receiptResult ) {
            return false;

        }

        $receipt_id = $receiptResult[ 'receipt_id' ];

        // Update the is_refunded status in the receipt table
        $updateReceiptSql = $this->connect()->prepare( 'UPDATE receipt SET is_refunded = 1 WHERE id = :receipt_id' );
        $updateReceiptSql->bindParam( ':receipt_id', $receipt_id, PDO::PARAM_INT );
        $updateReceiptSql->execute();
        return true;
    }

    public function getRefundedData($payment_id) {
        $sql = $this->connect()->prepare( 'SELECT
        refunded.prod_id,
        receipt.id AS ref_num,
        refunded.refunded_method_id AS method,
        refunded.refunded_qty AS qty,
        refunded.reference_num AS refund_num,
        users.first_name AS first_name,
        users.last_name AS last_name,
        discounts.name AS discountType,
        products.prod_price AS prod_price,
        products.prod_desc AS prod_desc,
        refunded.refunded_amt AS totalSubtotal,
        products.isVAT AS isVAT,
        payments.id,
        transactions.id,
        CASE
            WHEN products.isVAT = 1 THEN ROUND((refunded.refunded_amt / 1.12), 2)
            ELSE refunded.refunded_amt = 0
        END AS totalVatSales,
        CASE
            WHEN products.isVAT = 1 THEN ROUND(((refunded.refunded_amt / 1.12) * 0.12), 2)
            ELSE 0
        END AS VAT,
        ROUND((ROUND((CASE
            WHEN products.isVAT = 1 THEN refunded.refunded_amt / 1.12
            ELSE refunded.refunded_amt
            END), 2) * (discounts.discount_amount / 100)), 2) AS customer_discount
    FROM
        refunded
        INNER JOIN products ON products.id = refunded.prod_id
        INNER JOIN payments ON payments.id = refunded.payment_id
        INNER JOIN transactions ON transactions.payment_id = payments.id
        INNER JOIN receipt ON transactions.receipt_id = receipt.id
        INNER JOIN users ON users.id = transactions.user_id
        INNER JOIN discounts ON discounts.id = users.discount_id
    WHERE
        refunded.payment_id = :payment_id
        AND refunded.date = (SELECT MAX(`date`) FROM refunded WHERE payment_id = :payment_id)
    GROUP BY
        refunded.prod_id;
    
        ' );
        $sql->bindParam( ':payment_id', $payment_id, PDO::PARAM_INT );
        $sql->execute();

        $refunded = $sql->fetchAll( PDO::FETCH_ASSOC );

        return $refunded;
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function postCouponData($totalAmountCoupon, $r_id, $selectedData) {
      
        $qrNumber = bin2hex(random_bytes(10));
        $allowedIntervals = ['1 DAY', '2 DAY', '3 DAY','4 DAY','5 DAY', '1 WEEK', '1 MONTH', '1 YEAR'];

        if (in_array($selectedData, $allowedIntervals)) {
            $qrNumber = bin2hex(random_bytes(10));
            // Construct the SQL with the safe interval
            $sqlString = "INSERT INTO return_coupon (receipt_id, qrNumber, c_amount, transaction_dateTime, expiry_dateTime) VALUES (:r_id, :qrNumber, :amount, NOW(), DATE_ADD(NOW(), INTERVAL $selectedData))";
            $sql = $this->connect()->prepare($sqlString);
            $sql->bindParam(':r_id', $r_id);
            $sql->bindParam(':qrNumber', $qrNumber);
            $sql->bindParam(':amount', $totalAmountCoupon);
            $sql->execute();
        } else {
        
            throw new Exception("Invalid interval for expiry date.");
        }
        

        
        return true;
    }
    
    function getLatestReturnCouponData($r_id){
        
        $sql = $this->connect()->prepare("SELECT * FROM return_coupon where receipt_id = :r_id ORDER BY transaction_dateTime DESC LIMIT 1");
        $sql->bindParam(':r_id', $r_id);
        $sql->execute();
        $latestCoupon = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $latestCoupon;
    }

    public function returnExchange($product_id,$payment_id,$return_qty){

        $sql = $this->connect()->prepare('INSERT INTO return_exchange ( product_id, payment_id, return_qty, date ) VALUES ( :product_id, :payment_id, :return_qty, NOW() )');

        $sql->bindParam(':product_id', $product_id);
        $sql->bindParam(':payment_id', $payment_id);
        $sql->bindParam(':return_qty', $return_qty);
        $sql->execute(); 

        $updateSql = $this->connect()->prepare( 'UPDATE inventory SET stock = stock + :prod_qty, sold = sold - :prod_qty WHERE product_id = :prod_id' );
        $updateSql->bindParam( ':prod_qty', $return_qty, PDO::PARAM_INT );
        $updateSql->bindParam( ':prod_id', $product_id, PDO::PARAM_INT );
        $updateSql->execute();

        $fetchReceiptIdSql = $this->connect()->prepare( 'SELECT receipt_id FROM transactions WHERE payment_id = :payment_id ORDER BY id ASC LIMIT 1' );
        $fetchReceiptIdSql->bindParam( ':payment_id', $payment_id, PDO::PARAM_INT );
        $fetchReceiptIdSql->execute();
        $receiptResult = $fetchReceiptIdSql->fetch( PDO::FETCH_ASSOC );

        if ( !$receiptResult ) {
            return false;

        }

        $receipt_id = $receiptResult[ 'receipt_id' ];

        // Update the is_refunded status in the receipt table
        $updateReceiptSql = $this->connect()->prepare( 'UPDATE receipt SET is_refunded = 2 WHERE id = :receipt_id' );
        $updateReceiptSql->bindParam( ':receipt_id', $receipt_id, PDO::PARAM_INT );
        $updateReceiptSql->execute();

        return true;
    }

    public function getCouponsDataValidity($qrNum){
        // Prepare the SQL statement with an additional condition to check if the coupon is not expired
        $sql = $this->connect()->prepare("SELECT * FROM return_coupon WHERE qrNumber = :qr_number");
        $sql->bindParam(':qr_number', $qrNum, PDO::PARAM_STR); 
        $sql->execute();
        
        // Fetch all matching, non-expired coupons
        $coupons = $sql->fetchAll(PDO::FETCH_ASSOC);
        return ['success' => true, 'coupon' => $coupons];
    }
    
    


    public function getRefundedDataJS($payment_id, $reference_num) {
        $pdo = $this->connect();
        $sql = $pdo->prepare("SELECT 
        refunded.prod_id, 
        receipt.id AS ref_num,
        refunded.refunded_qty AS qty,
        refunded.reference_num AS refund_num,
        users.first_name AS first_name,
        users.last_name AS last_name,
        temporary_names.name AS temporary_name,
        discounts.name AS discountType,
        products.prod_price AS prod_price,
        products.prod_desc AS prod_desc,
        (refunded.refunded_amt) AS totalSubtotal,
        products.isVAT AS isVAT,
        payments.id, 
        transactions.id,
        refunded.date
    FROM 
        `refunded`
    INNER JOIN 
        products ON products.id = refunded.prod_id
    INNER JOIN 
        payments ON payments.id = refunded.payment_id
    INNER JOIN 
        transactions ON transactions.payment_id = payments.id
    INNER JOIN 
        receipt ON transactions.receipt_id = receipt.id
    INNER JOIN 
        users ON users.id = transactions.user_id
    INNER JOIN
        discounts ON discounts.id = users.discount_id
    LEFT JOIN
		temporary_names ON temporary_names.id = transactions.tempo_name
    WHERE 
        refunded.payment_id = '$payment_id' AND refunded.reference_num = '$reference_num'
    GROUP BY 
        refunded.reference_num;");

        $sql->execute();

    $refunded = $sql->fetchAll( PDO::FETCH_ASSOC );

    echo json_encode([
        'success' => true,
        'refunded' => $refunded
    ]);

    }

    public function SearchData($id){
        $sql = $this->connect()->prepare("SELECT * FROM transactions WHERE id = :id AND is_paid=0");
        $sql->bindParam(':id', $id, PDO::PARAM_INT); 
        $sql->execute();
        
        // Fetch all matching, non-expired coupons
        $id = $sql->fetchAll(PDO::FETCH_ASSOC);
        return ['success' => true, 't_id' => $id];
    }



    public function updateCouponVal($couponId) {
        $pdo = $this->connect();

        $q = $pdo->prepare("UPDATE `return_coupon` 
        SET 
          `isUse` = 1,
          `used_date` = CURRENT_TIMESTAMP
        WHERE id = ?");

        $q->execute([$couponId]);

        echo json_encode([
            'success' => true,
            'data' => "SUCCESS UPDATE",
        ]);
    }
    public function permission($userID){
        // $permi = $this->connect()->prepare("SELECT level FROM ability  WHERE user_id = :userID");
        $permi = $this->connect()->prepare("SELECT permission FROM abilities  WHERE user_id = :userID");
        $permi->bindParam(':userID', $userID, PDO::PARAM_STR);
        $permi->execute();

        $id =  $permi->fetchAll(PDO::FETCH_ASSOC);
        return $id;
    }

    function checkCredentials($inputPassword) {
        $stmt = $this->connect()->prepare("SELECT role_id, username, password FROM users  WHERE password = :password");
        $stmt->bindParam(':password', $inputPassword, PDO::PARAM_STR);
        $stmt->execute();
       
    
        if ($user = $stmt->fetch()) {
            if ($inputPassword === $user['password']) {
                if ($user['role_id'] == 1) {
                    return 'superadmin';
                } elseif ($user['role_id'] == 2) {
                    return 'admin';
                }
            }
        }
    
        return false; 
    }
    
}
