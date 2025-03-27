<?php

class ProductFacade extends DBConnection {

  public function verifyBarcode($barcode) {
    $sql = $this->connect()->prepare("SELECT * FROM products WHERE barcode = '$barcode' OR prod_desc = '$barcode'");
    $sql->execute();
    $count = $sql->rowCount();
    return $count;
  }

  public function fetchProducts() {
    $sql = $this->connect()->prepare("SELECT * FROM products");
    $sql->execute();
    return $sql;
  }

  public function fetchProduct($barcode) {
    $sql = $this->connect()->prepare("SELECT products.*, inventory.expiration_date FROM products
    INNER JOIN inventory ON products.id = inventory.product_id
    WHERE barcode = '$barcode' OR prod_desc = '$barcode';");
    $sql->execute();
    return $sql;
  }

  public function subtractQuantity($prodQty, $barcode) {
    $sql = $this->connect()->prepare("UPDATE products SET sold = (sold - $prodQty) WHERE barcode = '$barcode'");
    $sql->execute();
    return $sql;
  }

  public function decreaseStock() {
    $sql = $this->connect()->prepare("UPDATE products SET stocks = sold");
    $sql->execute();
    return $sql;
  }

  // public function increaseStockById($prodId) {
  //   $sql = $this->connect()->prepare("UPDATE products SET sold = stocks WHERE id = '$prodId'");
  //   $sql->execute();
  //   return $sql;
  // }

  public function increaseStock() {
    $sql = $this->connect()->prepare("UPDATE products SET sold = stocks");
    $sql->execute();
    return $sql;
  }

}

?>