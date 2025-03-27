<?php

include( __DIR__ . '/layout/header.php');
include( __DIR__ . '/utils/db/connector.php');
include( __DIR__ . '/utils/models/user-facade.php');
include( __DIR__ . '/utils/models/shop-facade.php');

$userFacade = new UserFacade;
$shopFacade = new ShopFacade;


if (isset($_POST["login"])) {
  $password = $_POST["password"];
  if (empty($password)) {
    array_push($invalid, 'Password should not be empty!');
  } else {

    $verifyUsername = $userFacade->verifyUsername($password);
    $login = $userFacade->login($password);

    if ($verifyUsername > 0) {
      while ($row = $login->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        header("Location: home.php?first_name=" . $firstName . "&last_name=" . $lastName . "&user_id=" . $id);
      }
    } else {
      array_push($invalid, "Incorrect password!");
    }
  }
}
?>

<main class="form-wrapper">
 
  <div class="card form-card p-0" style="">
   <div class="d-flex" style="justify-content: center;">
    <img style="height: 150px; width: 390px; margin-left: -25px;" src="./assets/img/tinkerpro-logo-light.png" class="img-fluid " alt="logo">
   </div>
   <div class="d-flex" style="justify-content: center">
    <form action="index.php" method="post">
        <div class="d-flex">
          <div style="margin-right: 10px" class="svg_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
              <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
            </svg>
          </div>
          <input type="password" id="password" name="password" autofocus placeholder="Scan ID or Type Password" class="form-control shadow-none me-2 custom-width" style="border-radius: 0; width: 360px;">
          <button type="submit" name="login" class="form-control primary-color-btn" style="width: auto; border: none; border-radius: 0;">Login</button>
        </div>
      </form>
   </div>
   <?php include('errors.php') ?>
  </div>
</main>

<div class="login_sys_info">
  <div class="d-flex" style="justify-content: flex-end">
    <img src="./assets/img/tinkerpro-logo-light.png" class="img-fluid " alt="logo">
  </div>
  <label for="">Store: <span style="font-style: italic">TinkerPro Retail Store</spans></label>
  <label for="">Date & Time: <span style="font-style: italic">April 08, 2024 04:22:21</spans></label>
  <label for="">Machine Name: <span style="font-style: italic">POS 1 (Local)</spans></label>
  <label for="">Connection Status: <span style="font-style: italic">Offline</spans></label>
  <label for="">Device ID: <span style="font-style: italic">21113242344545445</spans></label>
  <label for="">Software Version: <span style="font-style: italic">1.05</spans></label>
</div>

<?php include('./layout/footer.php') ?>

<script>
  function renderDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;
    var myDate = document.getElementById('dateDisplay');
    var myDate2 = document.getElementById('spanCurrentDate');

    myDate2.textContent = today;
    myDate.textContent = today;
  }
  renderDate();

  document.addEventListener("keyup", function(e) {
    // Exit app
    if (e.key == 'Escape') {
      close();
    }
  })
</script>