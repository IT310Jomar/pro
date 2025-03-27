<?php

class ZReading extends DBConnection {

  public function getAllPayments() {
    $pdo = $this->connect();
    $q = $pdo->prepare("SELECT payments.*
    FROM payments
    WHERE DATE(payments.date_time_of_payment) = CURDATE()");

    $q2 = $pdo->prepare("SELECT payments.* FROM payments");

    $q3 = $pdo->prepare("SELECT payments.* FROM payments
    WHERE DATE(payments.date_time_of_payment) < CURDATE();");

    $getTotalVatSales = $pdo->prepare("SELECT
        fcustomer_discount,
        VAT,
        totalVatSales,
        isVAT
    FROM (
      SELECT
        users.id AS customer_id,
        transactions.transaction_num,
        transactions.is_transact,
        payments.change_amount,
        payments.payment_amount,
        SUM(transactions.subtotal) AS total,
        SUM(transactions.discount_amount) AS totalDis,
        SUM(transactions.prod_qty) AS totalQty,
        SUM(products.vat_amount) AS totalVat,
        products.isVAT,
        CASE
          WHEN products.isVAT = 0 THEN ROUND((SUM(transactions.subtotal) / 1.12), 2)
          ELSE ROUND((SUM(transactions.subtotal) / 1.12), 2)
        END AS totalVatSales,
        CASE
          WHEN products.isVAT = 0 THEN ROUND(((SUM(transactions.subtotal) / 1.12) * 0.12), 2)
          ELSE ROUND((((SUM(transactions.subtotal) / 1.12) * 0.12)), 2)
        END AS VAT,
        ROUND((ROUND((SUM(transactions.subtotal) / 1.12), 2) * ((discounts.discount_amount) / 100)), 2) AS fcustomer_discount,
        receipt.id AS or_num,
        receipt.barcode
      FROM transactions
        INNER JOIN payments ON payments.id = transactions.payment_id
        INNER JOIN products ON products.id = transactions.prod_id
        INNER JOIN users ON users.id = transactions.user_id
        INNER JOIN discounts ON discounts.id = users.discount_id
        INNER JOIN receipt ON receipt.id = transactions.receipt_id
        WHERE DATE(payments.date_time_of_payment) = CURDATE()
      GROUP BY
        transactions.transaction_num,
        transactions.is_transact,
        payments.change_amount,
        payments.payment_amount,
        products.isVAT
    ) AS subquery;");




    $getAllCurrentTransactions = $pdo->prepare("SELECT
    or_num,
    barcode,
    customer_id,
    customer_type,
    customer_discount,
    customer_fname,
    cutomer_lname,
    total,
    totalDis,
    totalQty,
    transaction_num,
    is_transact,
    change_amount,
    payment_amount,
    payment_details,
    method,
    payment_method_id,
    date_time_of_payment,
    regular_discount,
    (totalDis + total) AS totalAmount,
    ROUND(((total) / 1.12), 2) AS totalVatSales,
    ROUND((((total) / 1.12) * 0.12), 2) AS VAT, 
    ROUND((ROUND(((total) / 1.12), 2) * (customer_discount / 100)),2) AS fcustomer_discount,
    totalVat,
    ((total * customer_discount) / 100) AS customerDisType,
    ROUND(total - (ROUND((ROUND(((total) / 1.12), 2) * (customer_discount / 100)),2)),2) AS toBePaid,
    isVAT
        FROM (
            SELECT
            (users.id) AS customer_id,
            (discounts.discount_amount) AS customer_discount,
            (users.first_name) AS customer_fname,
            (users.last_name) AS cutomer_lname,
            (discounts.name) AS customer_type,
            transactions.transaction_num,
            transactions.is_transact,
            payments.change_amount,   
            payments.payment_amount,
            payments.payment_details,
            payments.date_time_of_payment,
            payment_method.method,
            payments.payment_method_id,
            SUM(transactions.subtotal) AS total,
            SUM(transactions.discount_amount) AS totalDis,
            SUM(transactions.prod_qty) AS totalQty,
            SUM(products.vat_amount) AS totalVat,
            products.isVAT,
            regulars.discount_amount AS regular_discount,
            (receipt.id) AS or_num,
            receipt.barcode
            FROM transactions
            INNER JOIN payments ON payments.id = transactions.payment_id
            INNER JOIN products ON products.id = transactions.prod_id
            INNER JOIN users ON users.id = transactions.user_id
            INNER JOIN discounts ON discounts.id = users.discount_id
            INNER JOIN receipt ON receipt.id = transactions.receipt_id
            INNER JOIN payment_method ON payment_method.id = payments.payment_method_id
            LEFT JOIN regulars ON regulars.id = transactions.regular_discount_id
            WHERE DATE(payments.date_time_of_payment) = CURDATE()
            GROUP BY transactions.transaction_num, transactions.is_transact, payments.change_amount, payments.payment_amount
        ) AS subquery;");


    $return_product = $pdo->prepare("SELECT 
    return_exchange.*, 
    products.id as productID, 
    products.prod_price, 
    products.isVAT,
    receipt.id AS receipt_id,
    receipt.barcode AS receipt_num,
    ROUND((((SUM(products.prod_price)) / 1.12) * 0.12), 2) AS VAT
    FROM `return_exchange`
    INNER JOIN payments ON payments.id = return_exchange.payment_id
    INNER JOIN products ON products.id = return_exchange.product_id
    INNER JOIN transactions ON payments.id = transactions.payment_id
   	INNER JOIN receipt ON receipt.id = transactions.receipt_id
    WHERE return_exchange.product_id = products.id AND DATE(return_exchange.date) = CURDATE()
    GROUP BY return_exchange.id;");

    $refund_profuct = $pdo->prepare("SELECT 
    refunded.*,
    products.id as productID, 
    products.prod_price, 
    products.isVAT,
    receipt.id AS receipt_id,
    receipt.barcode AS receipt_num,
    payments.id AS paymentIDs,
    ROUND((((SUM(products.prod_price)) / 1.12) * 0.12), 2) AS VAT
    FROM refunded 
    INNER JOIN payments ON payments.id = refunded.payment_id
    INNER JOIN products ON products.id = refunded.prod_id
    INNER JOIN transactions ON payments.id = transactions.payment_id
   	INNER JOIN receipt ON receipt.id = transactions.receipt_id
    WHERE refunded.prod_id = products.id AND DATE(refunded.date) = CURDATE() AND refunded.payment_id = payments.id
    GROUP BY refunded.id;");

    $voidTransction = $pdo->prepare("SELECT transactions.*,
    SUM(transactions.subtotal) AS totalVoid,
    products.isVAT,
    receipt.id AS receipt_id,
    receipt.barcode AS receipt_num,
    ROUND((((SUM(transactions.subtotal)) / 1.12) * 0.12), 2) AS VAT
    FROM transactions
      INNER JOIN products ON products.id = transactions.prod_id
      INNER JOIN receipt ON receipt.id = transactions.receipt_id
      WHERE transactions.is_void = 2 AND DATE(transactions.date) = CURDATE()
      GROUP BY transactions.transaction_num, transactions.is_void, transactions.is_transact
      ORDER BY receipt.id ASC;");

    
    $transactionSummary = $pdo->prepare("SELECT payments.*
    FROM `payments`
    WHERE DATE(payments.date_time_of_payment) = CURDATE();");


    $cashIn_cashOut = $pdo->prepare("SELECT * FROM `cash_in_out` 
    WHERE DATE(`date`) = CURDATE();");


    $siBedAndEnd = $pdo->prepare("SELECT 
    payments.*,
    transactions.receipt_id,
    receipt.id AS receipt_id,
    receipt.barcode AS receipt_num
    FROM `payments`
    INNER JOIN transactions ON payments.id = transactions.payment_id
    INNER JOIN receipt ON receipt.id = transactions.receipt_id
    WHERE DATE(payments.date_time_of_payment) = CURDATE()
    GROUP BY receipt.id
    ORDER BY receipt.id ASC;");


    $q->execute();
    $q2->execute();
    $getTotalVatSales->execute();
    $getAllCurrentTransactions->execute();
    $return_product->execute();
    $voidTransction->execute();
    $refund_profuct->execute();
    $transactionSummary->execute();
    $cashIn_cashOut->execute();
    $siBedAndEnd->execute();
    $q3->execute();

    $response =   $q->fetchAll(PDO::FETCH_ASSOC); // current day sales
    $response2 =  $q2->fetchAll(PDO::FETCH_ASSOC); // over all sales
    $response3 =  $getTotalVatSales->fetchAll(PDO::FETCH_ASSOC);
    $response4 =  $getAllCurrentTransactions->fetchAll(PDO::FETCH_ASSOC);
    $response5 =  $return_product->fetchAll(PDO::FETCH_ASSOC);
    $response6 = $voidTransction->fetchAll(PDO::FETCH_ASSOC);
    $response7 = $refund_profuct->fetchAll(PDO::FETCH_ASSOC);
    $response8 = $transactionSummary->fetchAll(PDO::FETCH_ASSOC);
    $response9 = $cashIn_cashOut->fetchAll(PDO::FETCH_ASSOC);
    $response10 = $siBedAndEnd->fetchAll(PDO::FETCH_ASSOC);
    $response11 = $q3->fetchAll(PDO::FETCH_ASSOC);
          
    echo json_encode([
        'success' => true,
        'data' => $response,
        'data2' => $response2,
        'getTotalVat' => $response3,
        'getAllTransac' => $response4,
        'return_prod' => $response5,
        'void_transaction' => $response6,
        'refundedProduct' => $response7,
        'transactionSummary' => $response8,
        'cashIn_cashOut' => $response9,
        'si_beg_and_end' => $response10,
        'previous_sales' => $response11,
    ]);
  }
  public function getUpdateZCount() {

    // $pdo = $this->connect();
    // $sql = $pdo->prepare("UPDATE z_reading_count SET z_read_count = z_read_count + 1");
    // $sql->execute();

    // $z_reading_report = $pdo->prepare("INSERT INTO `z_reading`(`ref_number`, `date_time`, `cashier_id`, `total_sales`) 
    // VALUES (?,?,?,?)");
    // $date = date('Y-m-d', strtotime('03/23/2024')); 
    // $z_reading_report->execute(['00000001', $date, 1, 4000]);
  }


  public function resetZ_reading_report () {
    // $pdo = $this->connect();
    // $sql = $pdo->prepare("SELECT * FROM `z_reading_count` WHERE 1");
    // $sql->execute();

    // return $sql;
  }


  public function getAllZreading() {
    $pdo = $this->connect();
    $sql = $pdo->prepare("SELECT z_read.*,
    users.*
    FROM `z_read`
    INNER JOIN users ON users.id = z_read.cashier_id
    ORDER BY z_read.id DESC");
    $sql->execute();
    
    $response = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
      'success' => true,
      'data' => $response,
    ]);
  }

  public function postZReadReport($cashierId, $date_and_time, $totalSales, $z_read_allData) {
    $pdo = $this->connect();

    $validate = $pdo->prepare("SELECT * FROM `z_read`");
    $validate->execute();
    $rowCount = $validate->rowCount();

    $ref_value = "00000001";

    if ($rowCount > 0) {
        $max_ref_query = $pdo->query("SELECT MAX(CAST(ref_number AS UNSIGNED)) AS max_ref FROM z_read");
        $max_ref = $max_ref_query->fetch(PDO::FETCH_ASSOC);
        $ref_value = str_pad($max_ref['max_ref'] + 1, 8, '0', STR_PAD_LEFT);
    }

    $q = $pdo->prepare("INSERT INTO `z_read`(`ref_number`, `date_time`, `cashier_id`, `total_sales`, `all_data`) VALUES (?,?,?,?,?)");
    $q->execute([$ref_value, $date_and_time, $cashierId, $totalSales, $z_read_allData]);

    $q = $pdo->prepare('SELECT MAX(id) AS last_id FROM z_read');
    $q->execute();
    $result = $q->fetch();
    $lastZread = $result['last_id'];

    $udpate = $pdo->prepare("UPDATE `denomination` SET `z_reading_id` = '$lastZread' WHERE `z_reading_id` IS NULL");
    $udpate->execute();
    echo json_encode([
      'data' => [$ref_value, $cashierId, $date_and_time, $totalSales],
    ]);
  }

  public function postCashCount($cash_count) {
    $pdo = $this->connect();
    $stmt = $pdo->prepare("INSERT INTO `denomination`(`bills`, `pcs`, `subtotal_count`) VALUES (?,?,?)");
    foreach ($cash_count as $row) {
      $stmt->execute([$row->bills, $row->qty, $row->total]);
    }
  }

  public function getCashCountable() {
    $pdo = $this->connect();

    $q = $pdo->prepare("SELECT denomination.*,
    z_read.*,
    users.first_name,
    users.last_name,
    SUM(denomination.subtotal_count) AS totalCash
    FROM `denomination` 
    INNER JOIN z_read ON z_read.id = denomination.z_reading_id
    INNER JOIN users ON users.id = z_read.cashier_id
    WHERE z_read.id = denomination.z_reading_id;");
    $q->execute();

    $result = $q->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
      'data' => $result,
    ]);
  }

  public function getSpecificZreading($ref_num) {
    $pdo = $this->connect();
    $q = $pdo->prepare("SELECT `all_data` FROM `z_read` WHERE `ref_number` = '$ref_num'");
    $q->execute();
    $result = $q->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
      'data' => $result,
    ]);
  }

  public function getSpecificCashCount($id) {
    $pdo = $this->connect();
    $q = $pdo->prepare("SELECT * FROM denomination WHERE z_reading_id = '$id'");
    $q->execute();

    $res = $q->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
      'data' => $res,
    ]);
  }
}

