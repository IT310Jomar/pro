<?php
require( __DIR__ . '../../vendor/autoload.php');
include( __DIR__ . '/layout/header.php');
include( __DIR__ . '/utils/db/connector.php');
include( __DIR__ . '/utils/models/shop-facade.php');
include( __DIR__ . '/utils/models/series-facade.php');
include( __DIR__ . '/utils/models/paid-transactions.php');
include ( __DIR__ . '/barcode.php' );

use Mike42\Escpos;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;

use Mike42\Escpos\CapabilityProfiles\DefaultCapabilityProfile;
use Mike42\Escpos\CapabilityProfiles\SimpleCapabilityProfile;



function detectDefaultPrinter() {
  $command = 'powershell.exe -Command "Get-WmiObject -Query \"SELECT * FROM Win32_Printer WHERE Default=$true\" | ForEach-Object { $_.Name }"';
  $output = shell_exec($command);
  $defaultPrinter = trim($output);

  if (empty($defaultPrinter)) {
      throw new Exception("No default printer found.");
  }

  return $defaultPrinter;
}


try {
  $defaultPrinter = detectDefaultPrinter();
  $connector = new WindowsPrintConnector($defaultPrinter);
  $connector->write(Printer::GS.'L'.chr(0).chr(0));
  $connector->write(Printer::GS.'R'.chr(0).chr(0));
  $printer = new Printer($connector);

  $refundTransactions = new PaidTransaction;
  $shopFacade = new ShopFacade;





$r_id = isset($_GET['r_id']) ? $_GET['r_id'] : null;

 if (isset($_GET["first_name"])) {
  $firstName = $_GET["first_name"];
 }
 if (isset($_GET["last_name"])) {
  $lastName = $_GET["last_name"];
 }


$coupon = $refundTransactions->getLatestReturnCouponData($r_id);


foreach($coupon as $coupons) {
  $couponNumber = $coupons['qrNumber'];
  $validUntil = $coupons['expiry_dateTime'];
  $amount = $coupons['c_amount'];

  $couponDetails = array(
    "couponNumber" => $coupons['qrNumber'],
    "validUntil" => $coupons['expiry_dateTime'],
    "amount" => $coupons['c_amount']
);
}

$data = json_encode($couponDetails);

  $couponDetails = array(
    "couponNumber" => $coupons['qrNumber'],
    "validUntil" => $coupons['expiry_dateTime'],
    "amount" => $coupons['c_amount']
);


$data = json_encode($couponDetails);

$fetchShop = $shopFacade->fetchShop();
while ($row = $fetchShop->fetch(PDO::FETCH_ASSOC)) {
  $shopName = $row['shop_name'];
  $shopAddress = $row['shop_address'];
  $contactNumber = $row['contact_number'];
}
$date = new DateTime($validUntil);

$formattedDate = $date->format('F j, Y g:i A');


$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setEmphasis(true);
$printer -> setLineSpacing(20);
$printer -> text("$shopName\n\n\n\n\n\n");//ok
$printer -> text("Owned and Operated by: \n");
$printer -> text("UNKNOWN \n");
$printer -> text("GUN-OB LAPU-LAPU CITY, 6016 \n");
$printer -> text("VAR REG TIN: XXX-XXX-XXX-XXX \n");
$printer -> text("MIN: XXXXXXXXXXXXXXX \n");
$printer -> text("S/N: XXX-XXX-XXX-XXX \n");
$printer -> setEmphasis(false);
$printer -> text("CN: $contactNumber\n");//ok
$printer -> text("       \n\n");

$printer -> feed(1);
$printer -> setEmphasis(true);
$printer -> text("COUPON\n");//OK
$printer -> text("Valid Until: \n  $formattedDate\n");//OK
$printer -> text("QR Number:  $couponNumber\n");//OK
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Amount: Php $amount");
$printer -> text("       \n\n");

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->qrCode($data ,Printer::QR_ECLEVEL_L, 8);//$formattedAmount
$printer -> text("       \n");




$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("Name: \t _______________\n\n");
$printer -> text("TIN/ID/SC: \t _______________\n\n");
$printer -> text("Address: \t _______________\n\n");
$printer -> text("Signature: \t _______________\n\n");
$printer -> text("       \n\n");

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setEmphasis(true);
$printer -> setLineSpacing(20);
$printer -> text("       \n\n");
$printer -> text("       \n\n");

$printer -> setLineSpacing(20);
$printer -> cut();
$printer -> feed(10);
$printer -> pulse();
$printer -> close();

} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}