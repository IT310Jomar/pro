<?php 

session_start();
ob_start();

$invalid = array();
$success = array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Transak POS">
  <meta name="author" content="Appworks Co.">
  <link rel="icon" type="image/png" href="img/fav.png">
  <!-- CSS -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/datatables/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendor/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
  <link rel="stylesheet" href="assets/css/jquery.toast.css">
  <link rel="stylesheet" href="assets/css/flatpickr.min.css">
  <link rel="stylesheet" href="assets/css/custom.scss">
  <link rel="stylesheet" href="assets/css/jquery-ui.css">
  <!-- <link rel="stylesheet" href="assets/css/daterangepicker.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-XXXXX" crossorigin="anonymous" />

  <link rel="stylesheet" href="assets/dist/jquery.toast.min.css">
<!-- 
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
  <!-- <script src="assets/js/script.js"></script> -->
  <!-- <script type="text/javascript" src="assets/vendor/jquery/jquery.min.js"></script> -->
  <!-- <script src="assets/js/jquery.min.js"></script> -->
  <script src="assets/js/jquery-3.6.4.min.js"></script>
  <script src="assets/js/axios.min.js"></script>
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script -->
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/sweetalert2.all.min.js"></script>
  <script src="assets/js/jquery.toast.js"></script>
  <script src="assets/js/flatpickr.js"></script>



  <script src="assets/js/jquery-ui.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

  <script src="assets/dist/jquery.toast.min.js"></script>
  <!-- <script src="assets/js/daterangepicker.min.js"></script>
  <script src="assets/js/moment.min.js"></script> -->
  
</head>
<body>


<title>TinkerPro POS</title>



