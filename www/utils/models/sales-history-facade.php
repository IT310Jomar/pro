<?php


class SalesHistoyFacede extends DBConnection {

    

    public function getAllSales () {
        $pdo = $this->connect();

        $q = $pdo->prepare("SELECT
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
        barcode_img,
        date_time_of_payment,
        returnID,
        (totalDis + total) AS totalAmount,
        ROUND(((total) / 1.12), 2) AS totalVatSales,
        ROUND((((total) / 1.12) * 0.12), 2) AS VAT, 
        ROUND((ROUND(((total) / 1.12), 2) * (customer_discount / 100)),2) AS fcustomer_discount,
        totalVat,
        ((total * customer_discount) / 100) AS customerDisType,
        ROUND(total - (ROUND((ROUND(((total) / 1.12), 2) * (customer_discount / 100)),2)),2) AS toBePaid,
        isVAT,
        is_paid,
        is_void,
        is_refunded
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
                payments.date_time_of_payment,
                return_exchange.id AS returnID,
                SUM(transactions.subtotal) AS total,
                SUM(transactions.discount_amount) AS totalDis,
                SUM(transactions.prod_qty) AS totalQty,
                SUM(products.vat_amount) AS totalVat,
                products.isVAT,
                (receipt.id) AS or_num,
                receipt.barcode,
                receipt.barcode_img,
                receipt.is_refunded,
                transactions.is_paid,
                transactions.is_void
                FROM transactions
                INNER JOIN payments ON payments.id = transactions.payment_id
                INNER JOIN products ON products.id = transactions.prod_id
                INNER JOIN users ON users.id = transactions.user_id
                INNER JOIN discounts ON discounts.id = users.discount_id
                INNER JOIN receipt ON receipt.id = transactions.receipt_id
                LEFT JOIN temporary_names ON temporary_names.id = transactions.tempo_name
                LEFT JOIN return_exchange ON payments.id = return_exchange.payment_id
                GROUP BY transactions.transaction_num, transactions.is_transact, payments.change_amount, payments.payment_amount
                ORDER BY receipt.id DESC
            ) AS subquery;");
        $q->execute();
        
        $q2 = $pdo->prepare("SELECT
        (users.id) AS customer_id,
        (discounts.discount_amount) AS customer_discount,
        (users.first_name) AS customer_fname,
        (users.last_name) AS cutomer_lname,
        (temporary_names.name) AS temporary_name,
        (discounts.name) AS customer_type,
        payments.change_amount,   
        payments.payment_amount,
        payments.date_time_of_payment,
        refunded.refunded_amt AS totalRefunded,
        refunded.reference_num,
        refunded.payment_id,
        products.isVAT,
        transactions.subtotal,
        transactions.transaction_num,
        transactions.is_transact,
        receipt.barcode_img,
        (receipt.id) AS or_num,
        receipt.barcode,
        SUM(transactions.subtotal) AS total,
        receipt.is_refunded,
        (refunded.date) AS refunded_date_time
        FROM refunded
        INNER JOIN payments ON payments.id = refunded.payment_id
        INNER JOIN products ON products.id = refunded.prod_id
        INNER JOIN transactions ON payments.id = transactions.payment_id
        INNER JOIN receipt ON receipt.id = transactions.receipt_id
        INNER JOIN users ON users.id = transactions.user_id
        INNER JOIN discounts ON discounts.id = users.discount_id
        LEFT JOIN temporary_names ON temporary_names.id = transactions.tempo_name
        WHERE refunded.payment_id = payments.id
        GROUP BY refunded.reference_num;");

        $q2->execute();

        $response = $q->fetchAll(PDO::FETCH_ASSOC);
        $refund_data = $q2->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'data' => $response,
            'data2' => $refund_data,
        ]);
    }

    
}

?>