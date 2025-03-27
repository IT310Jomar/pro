<?php

class TransactionFacade extends DBConnection {
  
  public function getTransactions() {
    $sql = $this->connect()->prepare("SELECT transactions.*, (products.id) as prodCode, products.barcode, products.tax, products.vat_amount, products.isVAT 
    FROM transactions 
    INNER JOIN products ON products.id = transactions.prod_id
    WHERE transactions.is_transact = '0' AND transactions.is_void = '0' AND transactions.is_Save = '0'");
    $sql->execute();
    $response = $sql->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
      'transactions' => $response,
    ]);
  }

  public function deleteTransaction($transationId) {
    $sql = $this->connect()->prepare("DELETE FROM `transactions` WHERE id = '$transationId'");
    $sql->execute();
    $response = $sql->fetch(PDO::FETCH_ASSOC);
    echo json_encode([
      'data' => $transationId,
    ]);
  }

  public function getTransactionsByNum($transactionNum) {
    $sql = $this->connect()->prepare("SELECT transactions.*, 
		products.isVAT,
        SUM(transactions.prod_qty) AS totalProdQty,
        SUM(transactions.subtotal) AS totalSubtotal,
        SUM(transactions.discount_amount) AS discount_amount2
	FROM transactions 
        INNER JOIN products ON products.id = transactions.prod_id
        WHERE transaction_num = '$transactionNum' AND is_transact = '1'
        GROUP BY transactions.prod_id;");
    $sql->execute();
    return $sql;
  }


public function getTransactionsByNumJS($transactionNum) {
    $sql = $this->connect()->prepare("SELECT transactions.*, 
    payments.*,
		products.isVAT,
    users.first_name,
    users.last_name,
    temporary_names.name AS temporary_name,
    discounts.name,
    receipt.barcode_img,
        SUM(transactions.prod_qty) AS totalProdQty,
        SUM(transactions.subtotal) AS totalSubtotal
	FROM transactions 
        INNER JOIN products ON products.id = transactions.prod_id
        INNER JOIN payments ON payments.id = transactions.payment_id
        INNER JOIN users ON users.id = transactions.user_id
        INNER JOIN discounts ON discounts.id = users.discount_id
        INNER JOIN receipt ON receipt.id = transactions.receipt_id
        LEFT JOIN temporary_names ON temporary_names.id = transactions.tempo_name
        WHERE transaction_num = '$transactionNum' AND is_transact = '1'
        GROUP BY transactions.prod_id;");
    $sql->execute();


    $q = $this->connect()->prepare("SELECT * FROM payment_method");
    $q->execute();

    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    $paymentMethod = $q->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true, 
        'response' => $result,
        'paymentMethod' => $paymentMethod,
    ]);
  }

  public function getLatestTransactionNum() {
    $sql = $this->connect()->prepare("SELECT transaction_num, user_id FROM transactions WHERE is_transact = '1' ORDER BY transaction_num DESC LIMIT 1 ");
    $sql->execute();
    return $sql;
  }

  public function addTransaction($transactionNum, $prodId, $prodQty, $cashier, $prodDesc, $prodPrice, $subTotal, $sales, $date) {
    $sql = $this->connect()->prepare("INSERT INTO transactions(transaction_num, prod_id, prod_qty, cashier_id, prod_desc, prod_price, subtotal, sales, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->execute([$transactionNum, $prodId, $prodQty, $cashier, $prodDesc, $prodPrice, $subTotal, $sales, $date]);
    // return $sql;
    echo json_encode([
      'success' => 'Product has been added!',
    ]);
  }
//   public function getTotal() {
//     $sql = $this->connect()->prepare("SELECT 
//     totalVat, 
//     total, 
//     totalDis, 
//     totalQty, 
//     (totalDis + total) AS totalAmount,
//     (((totalVat)*12)/100) AS totalVatSales
// FROM (
//     SELECT 
//         SUM(transactions.subtotal) AS total, 
//         SUM(transactions.discount_amount) AS totalDis,  
//         SUM(transactions.prod_qty) AS totalQty,
//         SUM(products.vat_amount) AS totalVat
//     FROM transactions
//     INNER JOIN products ON products.id = transactions.prod_id
//     WHERE transactions.is_transact = '0'
// ) AS subquery;");
//     $sql->execute();
//     // $response = $sql->fetch(PDO::FETCH_ASSOC);
//     // echo json_encode([
//     //   'total' => $response 
//     // ]);
//     return $sql;
//   }

  public function getTotalForJS() {
    $sql = $this->connect()->prepare("SELECT 
    totalVat, 
    total, 
    totalDis, 
    totalQty, 
    (totalDis + total) AS totalAmount,
    (((totalVat)*12)/100) AS totalVatSales
    FROM (
        SELECT 
            SUM(transactions.subtotal) AS total, 
            SUM(transactions.discount_amount) AS totalDis,  
            SUM(transactions.prod_qty) AS totalQty,
            SUM(products.vat_amount) AS totalVat,
          products.isVAT
        FROM transactions
        INNER JOIN products ON products.id = transactions.prod_id
        WHERE transactions.is_transact = '0' AND transactions.is_Save = '0' AND transactions.is_void = 0
    ) AS subquery;");

    $q = $this->connect()->prepare("SELECT 
        total, 
        totalDis, 
        totalQty, 
        (totalDis + total) AS totalAmount,
        ROUND(((totalDis + total) / 1.12),2) AS totalVatSales,
        ROUND((ROUND(((totalDis + total) / 1.12),2) * 0.12),2) AS totalVat,
        isVAT
    FROM (
        SELECT 
          SUM(transactions.subtotal) AS total, 
            SUM(transactions.discount_amount) AS totalDis,  
            SUM(transactions.prod_qty) AS totalQty,
          products.isVAT
            FROM transactions
            INNER JOIN products ON products.id = transactions.prod_id
            WHERE transactions.is_transact = '0' AND 
            products.isVAT = 1 AND transactions.is_Save = '0' AND transactions.is_void = 0
    ) AS subquery;");
      
    $sql->execute();
    $response = $sql->fetch(PDO::FETCH_ASSOC);
    $q->execute();
    $res = $q->fetch(PDO::FETCH_ASSOC);
    echo json_encode([
      'total' => $response,
      'total2' => $res, 
    ]);
  }

  public function getTotalVat($transactionNum, $cusId) {
    if($cusId == 6 || $cusId == '6') {
      echo 'Add query here!';

      $q = $this->connect()->prepare("SELECT
      customer_id,
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
      WHERE transactions.transaction_num = '$transactionNum' AND transactions.is_transact = 1
      GROUP BY
        transactions.transaction_num,
        transactions.is_transact,
        payments.change_amount,
        payments.payment_amount,
        users.id,
        discounts.discount_amount,
        discounts.name,
        products.isVAT
    ) AS subquery;");
    
    } else {
      $q = $this->connect()->prepare("SELECT
      customer_id,
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
      WHERE transactions.transaction_num = '$transactionNum' AND transactions.is_transact = 1
      GROUP BY
        transactions.transaction_num,
        transactions.is_transact,
        payments.change_amount,
        payments.payment_amount,
        users.id,
        discounts.discount_amount,
        discounts.name,
        products.isVAT
    ) AS subquery;");
    }
    $q->execute();
    return $q;
  }

  public function getTotalByNum($transactionNum, $cusId) {
    if($cusId == 6 || $cusId == '6') {
      $sql = $this->connect()->prepare("SELECT
      or_num,
      barcode,
      customer_id,
      customer_type,
      customer_discount,
      customer_fname,
      cutomer_lname,
      temporary_name,
      total,
      totalDis,
      totalQty,
      transaction_num,
      is_transact,
      change_amount,
      payment_amount,
      payment_amount,
      payment_details,
      method,
      payment_method_id,
      date_time_of_payment,
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
              (temporary_names.name) AS temporary_name,
              (discounts.name) AS customer_type,
              transactions.transaction_num,
              transactions.is_transact,
              payments.change_amount,
              payments.payment_details,
              payments.date_time_of_payment,
              payment_method.method,
              payments.payment_method_id,   
              payments.payment_amount,
              SUM(transactions.subtotal) AS total,
              SUM(transactions.discount_amount) AS totalDis,
              SUM(transactions.prod_qty) AS totalQty,
              SUM(products.vat_amount) AS totalVat,
              products.isVAT,
              (receipt.id) AS or_num,
              receipt.barcode
              FROM transactions
              INNER JOIN payments ON payments.id = transactions.payment_id
              INNER JOIN products ON products.id = transactions.prod_id
              INNER JOIN users ON users.id = transactions.user_id
              INNER JOIN discounts ON discounts.id = users.discount_id
              INNER JOIN receipt ON receipt.id = transactions.receipt_id
              INNER JOIN payment_method ON payment_method.id = payments.payment_method_id
              LEFT JOIN temporary_names ON temporary_names.id = transactions.tempo_name
              WHERE transactions.transaction_num = '$transactionNum' AND transactions.is_transact = 1
              GROUP BY transactions.transaction_num, transactions.is_transact, payments.change_amount, payments.payment_amount
          ) AS subquery;");
    } else {
      $sql = $this->connect()->prepare("SELECT
      or_num,
      barcode,
      customer_id,
      customer_type,
      customer_discount,
      customer_fname,
      cutomer_lname,
      temporary_name,
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
              (temporary_names.name) AS temporary_name,
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
              (receipt.id) AS or_num,
              receipt.barcode
              FROM transactions
              INNER JOIN payments ON payments.id = transactions.payment_id
              INNER JOIN products ON products.id = transactions.prod_id
              INNER JOIN users ON users.id = transactions.user_id
              INNER JOIN discounts ON discounts.id = users.discount_id
              INNER JOIN receipt ON receipt.id = transactions.receipt_id
              INNER JOIN payment_method ON payment_method.id = payments.payment_method_id
              LEFT JOIN temporary_names ON temporary_names.id = transactions.tempo_name
              WHERE transactions.transaction_num = '$transactionNum' AND transactions.is_transact = 1
              GROUP BY transactions.transaction_num, transactions.is_transact, payments.change_amount, payments.payment_amount
          ) AS subquery;");
    }
    
    // $sql = $this->connect()->prepare("SELECT SUM(subtotal) AS total FROM transactions WHERE transaction_num = '$transactionNum' AND is_transact = '1'");
    $sql->execute();
    return $sql;
  }

  public function clearTransaction() {
    $sql = $this->connect()->prepare("UPDATE transactions SET is_transact = '1', is_paid = '1'");
    $sql->execute();
    return $sql;
  }

  public function clearTransactionPayLater() {
    $sql = $this->connect()->prepare("UPDATE transactions SET is_transact = '1'");
    $sql->execute();
    return $sql;
  }

  public function voidProduct($prodId) {
    $sql = $this->connect()->prepare("DELETE FROM transactions WHERE prod_id = '$prodId'");
    $sql->execute();
    return $sql;
  }

  public function updatePayer($transactionNum, $payer) {
    $sql = $this->connect()->prepare("UPDATE transactions SET transact_type = '1', payer = '$payer' WHERE transaction_num = '$transactionNum'");
    $sql->execute();
    return $sql;
  }

  public function updateQty($id, $qty) {
    $sql = $this->connect()->prepare("UPDATE transactions SET prod_qty = '$qty', subtotal = ('$qty' * prod_price) - discount_amount  WHERE id = '$id';");
    $sql->execute();


    $q = $this->connect()->prepare("SELECT subtotal FROM transactions WHERE id = '$id'");
    $q->execute();

    $response = $q->fetch(PDO::FETCH_ASSOC);
    echo json_encode([
      'success' => true,
      'data' => $response,
    ]);
  }
  
  public function updateTransaction($id, $transacNo, $sub, $disType, $discount) {
    if($disType == 0) {
      $totalDiscount = $sub * $discount / 100;
      $q = $this->connect()->prepare("UPDATE transactions SET subtotal = '$sub' - '$totalDiscount', discount_type = '$disType', discount_amount = '$totalDiscount' WHERE id = '$id'");
      $q->execute();
      
      // echo json_encode([
      //   'success' => true,
      //   'updated' => 'SUCCESS! %',
      // ]);
    }
    else {
      $totalDiscount = ($sub - $discount) ;
      $q = $this->connect()->prepare("UPDATE transactions SET subtotal = '$totalDiscount', discount_type = '$disType', discount_amount = '$discount'  WHERE id = '$id'");
      $q->execute();

      // echo json_encode([
      //   'success' => true,
      //   'updated' => 'SUCCESS! Php',
      // ]);
    }
  }

  public function updateTransaCartDis($transacNo, $sub, $disType, $discount) {

    if($disType == 0) {
      $totalDiscount = $sub * $discount / 100;
      $q = $this->connect()->prepare("UPDATE transactions SET discount_type = '$disType', cart_discount_amount = '$totalDiscount' WHERE transaction_num = '$transacNo'");
      $q->execute();
      return $q;
    }
    else {
      $totalDiscount = ($sub - $discount) ;
      $q = $this->connect()->prepare("UPDATE transactions SET discount_type = '$disType', cart_discount_amount = '$discount' WHERE transaction_num = '$transacNo'");
      $q->execute();
      return $q;
    }
  }

  public function getAllDiscounts() {
    $q = $this->connect()->prepare("SELECT * FROM discounts");
    $q->execute();
    
    $response = $q->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['data' => $response]);
  }


  public function getAllProducts() {
    $q = $this->connect()->prepare("SELECT products.*, inventory.*
    FROM products
    INNER JOIN inventory ON products.id = inventory.product_id;");
    $q->execute();
    $response = $q->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
      'products' => $response,
    ]);
  }

  public function postPayment($cash, $change, $transac_num, $customerId, $regularDis, $paymentMetVal, $otherDetails) {
    $pdo = $this->connect();
    try {

        $getPaymentMethod = $pdo->prepare("SELECT * FROM payment_method");
        $getPaymentMethod->execute();

        foreach ($getPaymentMethod as $paymentData) {
          if ($paymentData['id'] == $paymentMetVal) {
            $paymentMethodId = $paymentData['id'];
            $q = $pdo->prepare("INSERT INTO `payments`(`change_amount`, `payment_amount`, `payment_details`, `payment_method_id`) VALUES (?, ?, ?, ?)");
            $q->execute([$change, $cash, $otherDetails , $paymentMethodId]);
          }
           
          // if($paymentMetVal == 6) {
          //   if ($paymentData['id'] == $paymentMetVal) {
          //     $paymentMethodId = $paymentData['id'];
          //     $q = $pdo->prepare("INSERT INTO `payments`(`change_amount`, `payment_amount`, `payment_details`, `payment_method_id`) VALUES (?, ?, ?, ?)");
          //     $q->execute([$change, $cash, $otherDetails , $paymentMethodId]);
          //   } 
          // } else {
          //   if ($paymentData['id'] == $paymentMetVal) {
          //     $paymentMethodId = $paymentData['id'];
          //     $q = $pdo->prepare("INSERT INTO `payments`(`change_amount`, `payment_amount`, `payment_method_id`) VALUES (?, ?, ?)");
          //     $q->execute([$change, $cash, $paymentMethodId]);
          //   } 
          // }
        }
    
        $updatedRecord = [];
        $rowCount = $q->rowCount();
        if ($rowCount > 0) {
            $lastInsertId = $pdo->lastInsertId();
            try {
                if($customerId === '6') {
                  $sql2 = $pdo->prepare("INSERT INTO `regulars`(`user_id`, `discount_amount`) VALUES (?,?);");
                  $sql2->execute([$customerId, $regularDis]);
                  $lastInsertedInRegular = $pdo->lastInsertId();

                  $insertNewReceipt = $pdo->prepare("INSERT INTO `receipt`(`barcode`, `barcode_img`) VALUES (?,?)");
                  $insertNewReceipt->execute([' ', null]);
                  $lastReceiptId = $pdo->lastInsertId();
               
                  $lastReceiptIdPadded = str_pad($lastReceiptId, 8, '0', STR_PAD_LEFT);
                  $updateBarcode = $pdo->prepare("UPDATE `receipt` SET `barcode` = ? WHERE `id` = ?");
                  $updateBarcode->execute([$lastReceiptIdPadded, $lastReceiptId]);

                  $sql = $pdo->prepare("UPDATE `transactions` SET  `user_id` = ?, `regular_discount_id` = ?, `payment_id` = ?, `receipt_id` = ?, `is_transact`= 1 ,`is_paid`= 1 WHERE `transaction_num` = ?");
                  $sql->execute([$customerId, $lastInsertedInRegular, $lastInsertId, $lastReceiptId, $transac_num]);

                  $getReceiptNo = $pdo->prepare("SELECT * FROM `transactions` WHERE `transaction_num` = ?");
                  $getReceiptNo->execute([$transac_num]);
                  $updatedRecord = $getReceiptNo->fetch(PDO::FETCH_ASSOC);

                } else {
                  $insertNewReceipt = $pdo->prepare("INSERT INTO `receipt`(`barcode`, `barcode_img`) VALUES (?,?)");
                  $insertNewReceipt->execute([' ', null]);
                
                  $lastReceiptId = $pdo->lastInsertId();

                  $lastReceiptIdPadded = str_pad($lastReceiptId, 8, '0', STR_PAD_LEFT);
                  $updateBarcode = $pdo->prepare("UPDATE `receipt` SET `barcode` = ? WHERE `id` = ?");
                  $updateBarcode->execute([$lastReceiptIdPadded, $lastReceiptId]);
                  
                  $sql = $pdo->prepare("UPDATE `transactions` SET  `user_id` = '$customerId', `payment_id` = ?, `receipt_id` = ?, `is_transact`= 1 ,`is_paid`= 1 WHERE `transaction_num` = ?");
                  $sql->execute([$lastInsertId, $lastReceiptId, $transac_num]);

                  $getReceiptNo = $pdo->prepare("SELECT * FROM `transactions` WHERE `transaction_num` = ?");
                  $getReceiptNo->execute([$transac_num]);
                  $updatedRecord = $getReceiptNo->fetch(PDO::FETCH_ASSOC);

                  $getLastUpdatTransac = $pdo->prepare("SELECT * FROM `transactions` WHERE `transaction_num` = :transac_num");
                  $getLastUpdatTransac->bindParam(':transac_num', $transac_num, PDO::PARAM_STR);

                  $getLastUpdatTransac->execute();
                  $getTransacProduct = $pdo->prepare(
                      "SELECT transactions.*, 
                              products.isVAT,
                              products.id AS product_id,
                              SUM(transactions.prod_qty) AS totalProdQty,
                              SUM(transactions.subtotal) AS totalSubtotal
                          FROM transactions 
                          INNER JOIN products ON products.id = transactions.prod_id
                          WHERE transaction_num = :transac_num AND is_transact = '1'
                          GROUP BY transactions.prod_id;"
                  );
                  $getTransacProduct->bindParam(':transac_num', $transac_num, PDO::PARAM_STR);
                  $getTransacProduct->execute();

                  foreach ($getLastUpdatTransac as $updatedTransac) {
                      $updated_id = $updatedTransac['prod_id'];
                      while ($data = $getTransacProduct->fetch(PDO::FETCH_ASSOC)) {
                          $prodQty = $data['totalProdQty'];
                          $id_prod = $data['product_id'];
                          if ($id_prod == $updated_id) {
                              $q = $pdo->prepare("UPDATE `inventory` SET `stock` = (`stock` - :prodQty), `sold` = (`sold` + :prodQty) WHERE product_id = :id_prod");
                              $q->bindParam(':prodQty', $prodQty, PDO::PARAM_INT);
                              $q->bindParam(':id_prod', $id_prod, PDO::PARAM_INT);
                              $q->execute();
                          }
                      }
                  }
                }

                $rowCount = $sql->rowCount();
                if ($rowCount > 0) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Transactions Updated',
                        'or_number' => $updatedRecord,
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to Transactions Update',
                        'or_number' => $updatedRecord,
                    ]);
                }
            } catch (PDOException $e) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to insert payment data.',
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage(),
        ]);
    }
}

  public function getSaveTransac() 
  {
    $pdo = $this->connect();
    $q = $pdo->prepare("SELECT temporary_names.id, transactions.cashier_id, temporary_names.name, transactions.transaction_num,
    SUM(transactions.subtotal) AS Total, 
        SUM(transactions.prod_qty) AS qty 
    FROM `transactions` 
    INNER JOIN temporary_names ON temporary_names.id = transactions.tempo_name
    WHERE transactions.is_Save = 1 
      AND transactions.is_transact = 0 
      AND transactions.is_void = 0
      AND transactions.tempo_name IS NOT NULL
    GROUP BY temporary_names.id, temporary_names.name;");

    $q->execute();
    $res = $q->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
      'success' => true,
      'data' => $res,
    ]);
  }


  public function getUpdateSaved($id) {
    $pdo = $this->connect();
    $q = $pdo->prepare("UPDATE `transactions` SET `is_Save`='0' WHERE tempo_name = ?");
    $q->execute([$id]);

    $q2 = $pdo->prepare("SELECT transactions.tempo_name, temporary_names.* 
    FROM transactions 
    INNER JOIN temporary_names ON temporary_names.id = transactions.tempo_name
    WHERE transactions.tempo_name IS NOT NULL AND
    temporary_names.id = $id");
    $q2->execute();
  
    $response = $q2->fetch(PDO::FETCH_ASSOC);
   
    echo json_encode([
      'success' => true,
      'data' => $response,
    ]);
  }


  public function savedTransac($name, $transacNo) {
    $pdo = $this->connect();
    $sql = $pdo->prepare("INSERT INTO `temporary_names`(`name`) VALUES (?)");
    $sql->execute([$name]);

    $lastInserted = $pdo->lastInsertId();
    $q = $pdo->prepare("UPDATE `transactions` SET tempo_name = '$lastInserted', `is_Save`='1' WHERE transaction_num = '$transacNo'");
    $q->execute();

    echo json_encode([
      'success' => true,
      'data' => 'Successfully Saved!',
    ]);
  }

  
  public function voidTransactions($transac_num, $void_indicator) {
    $pdo = $this->connect();

    if($void_indicator == 0) {
      $q = $pdo->prepare("UPDATE `transactions` SET `is_void`='1' WHERE transactions.transaction_num = ?");
      $q->execute([$transac_num]);
      
    } else if($void_indicator == 1) {
      $q = $pdo->prepare("UPDATE `transactions` SET `is_void`='2' WHERE transactions.transaction_num = ?");
      $q->execute([$transac_num]);
    }
    
    echo json_encode([
      'success' => true,
      'data' => 'Successfully Updated',
    ]);
  }


  // public function postSplitPayment($cashSplit, $gcashSplit,  $mayaSplit, $debitSplit,  $creditSplit) {
  //   $pdo = $this->connect();

  //   $q = $pdo->prepare("");

  // }


  public function getAllMethodPayment() {
    $pdo = $this->connect();
    $q = $pdo->prepare("SELECT * FROM `payment_method`");
    $q->execute();


    $response = $q->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
      'success' => true,
      'data' => $response,
    ]);
  }


  public function getDeleteSavedTransactions($deleteSaved) {
    $pdo = $this->connect();
    for($i = 0; $i < count($deleteSaved); $i++) {
      $q = $pdo->prepare("DELETE FROM `transactions` WHERE transaction_num = ?");
      $q->execute([$deleteSaved[$i]]);
    }

    echo json_encode([
      "success"=> true,
    ]);
  }

}

?>