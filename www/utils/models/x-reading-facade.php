<?php 


class XReading extends DBConnection {


    public function getAllUserXReading() {
        $pdo = $this->connect();
        $q = $pdo->prepare("SELECT payments.*,
        transactions.cashier_id,
        receipt.barcode,
        receipt.id AS receipt_num_id,
        users.first_name,
        users.last_name
            FROM payments
            INNER JOIN transactions ON payments.id = transactions.payment_id
            INNER JOIN receipt ON receipt.id = transactions.receipt_id
            INNER JOIN users ON users.id = transactions.cashier_id
            WHERE DATE(payments.date_time_of_payment) = CURDATE()
            GROUP BY users.id;");
        $q->execute();



        $q2 = $pdo->prepare("SELECT payments.*,
        transactions.cashier_id,
        receipt.barcode,
        receipt.id AS receipt_num_id,
        users.first_name,
        users.last_name
            FROM payments
            INNER JOIN transactions ON payments.id = transactions.payment_id
            INNER JOIN receipt ON receipt.id = transactions.receipt_id
            INNER JOIN users ON users.id = transactions.cashier_id
            WHERE DATE(payments.date_time_of_payment) = CURDATE()
            GROUP BY payments.id;");
        $q2->execute();
        
        $res1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $res2 = $q2->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            'res1' => $res1,
            'res2' => $res2,
        ]);
    }
}
