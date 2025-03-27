<?php

class SeriesFacade extends DBConnection {

  public function getLatestSeries() {
    $sql = $this->connect()->prepare("SELECT series FROM series ORDER BY series DESC LIMIT 1 ");
    $sql->execute();
    $response = $sql->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
      'success' => true,
      'data' => $response,
    ]);
  }

  public function updateSeries() {
    $sql = $this->connect()->prepare("UPDATE series SET series = series + 1");
    $sql->execute();
    
    // echo json_encode([
    //   'success' => true,
    //   'data' => "UPDATED SERIES",
    // ]);
  }

}

?>