

<?php

include( __DIR__ . '/layout/header.php');
include( __DIR__ . '/utils/db/connector.php');
include( __DIR__ . '/utils/models/user-facade.php');
include( __DIR__ . '/utils/models/shop-facade.php');



?>

<div class="dashboard-container">
    <h3>Dashboard</h3>
    <ul>
        <li><a href="#">Dashboard Item 1</a></li>
        <li><a href="#">Dashboard Item 1</a></li>
        <li><a href="#">Dashboard Item 1</a></li>
    </ul>
</div>

  <!-- Main content area -->
<div class="container-fluid" style="margin-left: 230px; color: #fff;">
    <h1>Main Content</h1>
    <p>This is the main content area of your page.</p>
</div>




<style>
    .dashboard-container {
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      width: 230px; /* Adjust width as needed */
      background-color: #333333;
      border-right: 1px solid #4B413E;
      padding: 20px;
      color: #fff;
    }
    .dashboard-container ul {
      list-style-type: none;
      padding: 0;
    }
    .dashboard-container ul li {
      margin-bottom: 10px;
      margin-top: 10px;
    }
</style>