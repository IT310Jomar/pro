<?php


class CashInOrOut extends DBConnection {


    public function cashInOrOut($cashInOrOut, $cash_amount, $reason_note, $cashierId ) {

        $pdo = $this->connect();

        if($cashInOrOut == 0) {

            $q = $pdo->prepare("INSERT INTO `cash_in_out`(`cash_in_amount`, `user_id`, `reason_note`, `cashType`) VALUES (?,?,?,?)");
            $q->execute([$cash_amount, $cashierId, $reason_note, $cashInOrOut]);
        } else {

            $q = $pdo->prepare("INSERT INTO `cash_in_out`(`cash_out_amount`, `user_id`, `reason_note`, `cashType`) VALUES (?,?,?,?)");
            $q->execute([$cash_amount, $cashierId, $reason_note, $cashInOrOut]);
        }

        echo json_encode([
            'success' => true,
        ]);
    }


    public function getAllHistoryCashInOut($cashierId) {
        $pdo = $this->connect();
        $q = $pdo->prepare("SELECT cash_in_out.*, users.first_name, users.last_name FROM `cash_in_out`
        INNER JOIN users ON users.id = cash_in_out.user_id
        WHERE cash_in_out.user_id = '$cashierId'
        ");
        $q->execute();

        $response = $q->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'data' => $response,
        ]);

    }

}