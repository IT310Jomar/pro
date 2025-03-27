<?php

class UserFacade extends DBConnection {

  public function login($username) {
    $sql = $this->connect()->prepare("SELECT * FROM users WHERE password = ?");
    $sql->execute([$username]);
    return $sql;
  }

  public function verifyUsername($username) {
    $sql = $this->connect()->prepare("SELECT username, password FROM users WHERE password = ?");
    $sql->execute([$username]);
    $count = $sql->rowCount();
    return $count;
  }

  // public function login($username, $password) {
  //   $sql = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  //   $sql->execute([$username, $password]);
  //   return $sql;
  // }

  // public function verifyUsernameAndPassword($username, $password) {
  //   $sql = $this->connect()->prepare("SELECT username, password FROM users WHERE username = ? AND password = ?");
  //   $sql->execute([$username, $password]);
  //   $count = $sql->rowCount();
  //   return $count;
  // }

  public function fetchShop() {
    $sql = $this->connect()->prepare("SELECT * FROM users");
    $sql->execute();
    return $sql;
  }

  public function loginUser($username, $password) {
    $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct
        return true;
    }

    // Username or password is incorrect
    return false;
}


public function getAllCustomerUser() {
  $q = $this->connect()->prepare("SELECT users.*, (users.id) AS userId, discounts.* FROM users
  INNER JOIN discounts ON discounts.id = users.discount_id
  WHERE role_id = 4;");
  $q->execute();
  $response = $q->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode([
    'customer' => $response,
  ]);
}
public function getPermissionData($user_id){
  $sql = $this->connect()->prepare("SELECT * FROM abilities WHERE user_id = :user_id");
  $sql->bindParam(':user_id', $user_id);
  $sql->execute();
  $perm =  $sql->fetchAll(PDO::FETCH_ASSOC);
return  $perm;
}

public function addCustomer($addCustomerInfo) {
  $pdo = $this->connect();
  
  $stmt = $pdo->prepare('INSERT INTO `users`(`role_id`, `discount_id`, `first_name`, `last_name`) VALUES (?,?,?,?)');
  $stmt->execute([4, $addCustomerInfo->customer_type_discount, $addCustomerInfo->cf_name, $addCustomerInfo->cl_name]);

  $lastInsertedId = $pdo->lastInsertId();

  $sql = $pdo->prepare("INSERT INTO `customer`(`user_id`, `contact`, `email`, `is_tax_exempt`) VALUES (?,?,?,?)");
  $sql->execute([$lastInsertedId, $addCustomerInfo->c_contact, $addCustomerInfo->c_email, $addCustomerInfo->customer_tax_payer]);

  echo json_encode([
    'data' => 'SUCCESS',
  ]);
}


}

