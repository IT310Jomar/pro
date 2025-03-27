<?php 

// session_start();

require( __DIR__ . '../../vendor/autoload.php');
include( __DIR__ . '/layout/header.php');
include( __DIR__ . '/utils/db/connector.php');
include( __DIR__ . '/utils/models/shop-facade.php');
include( __DIR__ . '/utils/models/series-facade.php');
include( __DIR__ . '/utils/models/transaction-facade.php');

use Mike42\Escpos;
use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;
use Mike42\Escpos\CapabilityProfiles\DefaultCapabilityProfile;
use Mike42\Escpos\CapabilityProfiles\SimpleCapabilityProfile;

$connector = new WindowsPrintConnector("XP-58");
$printer = new Printer($connector);
$shopFacade = new ShopFacade;
$seriesFacade = new SeriesFacade;
$transactionFacade = new TransactionFacade;

if (isset($_GET["first_name"])) {
  $firstName = $_GET["first_name"];
}
if (isset($_GET["last_name"])) {
  $lastName = $_GET["last_name"];
}
if (isset($_GET["transaction_num"])) {
  $transactionNum = $_GET["transaction_num"];
}

// Get the shop info
$fetchShop = $shopFacade->fetchShop();
while ($row = $fetchShop->fetch(PDO::FETCH_ASSOC)) {
  $shopName = $row['shop_name'];
  $shopAddress = $row['shop_address'];
  $contactNumber = $row['contact_number'];
}

// Get the time and date
date_default_timezone_set("Asia/Manila");
$date = date("m/d/Y");
$time = date("h:i:sa");

// Add spaces for layout
function addSpaces($string = '', $valid_string_length = 0) {
  if (strlen($string) < $valid_string_length) {
    $spaces = $valid_string_length - strlen($string);
    for ($index1 = 1; $index1 <= $spaces; $index1++) {
      $string = $string . ' ';
    }
  }
  return $string;
}

$transactions = $transactionFacade->getTotalByNum($transactionNum)->fetchAll();
foreach($transactions as $transaction) {
  $total = $transaction['total'];
  $totalDis = $transaction['totalDis'];
  $totalQty = $transaction['totalQty'];
  $totalAmount = $transaction['totalAmount'];
  $cash = $transaction['payment_amount'];
  $change = $transaction['change_amount'];
}

// Print receipt
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setEmphasis(true);
$printer -> setLineSpacing(10);
$printer -> text("$shopName\n\n\n\n\n\n\n");
$printer -> text("Owned and Operated by: \n\n");
$printer -> text("LOU ZEUS BACULIO \n\n");
$printer -> text("GUN-OB LAPU-LAPU CITY, 6016 \n\n");
$printer -> text("VAR REG TIN: XXX-XXX-XXX-XXX \n\n");
$printer -> text("MIN: XXXXXXXXXXXXXXX \n\n");
$printer -> text("S/N: XXX-XXX-XXX-XXX \n\n");
$printer -> setEmphasis(false);
// $printer -> text("$shopAddress\n");
$printer -> text("CN: $contactNumber\n\n");
$printer -> feed(1);
$printer -> setEmphasis(true);
$printer -> text("ORIGINAL\n\n");
$printer -> setEmphasis(false);
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("Terminal: " . getenv('COMPUTERNAME') . "\n\n"); 
$printer -> text("Trans #: $transactionNum\n\n");
$printer -> text("Cashier: $firstName $lastName\n\n");
$printer -> text("Date: $date\n\n");
$printer -> text("Time: $time\n\n");
$printer -> feed(1);
$printer -> text("Payer: Alex \n\n");
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> feed(1);
$printer -> setEmphasis(true);
$printer -> text(addSpaces('Item(s)', 20) . addSpaces('Subtotal', 10) . "\n");
$printer -> setEmphasis(false);
$printer -> text("------------------------------\n");
$printer -> feed(1);

$items = $transactionFacade->getTransactionsByNum($transactionNum)->fetchAll();
foreach ($items as $item) {
  //Current item ROW 1
  $name_lines = str_split($item['prod_qty'] . 'x' . number_format($item['prod_price'], 2) . ' - ' . $item['prod_desc'], 20);
  foreach ($name_lines as $k => $l) {
    $l = trim($l);
    $name_lines[$k] = addSpaces($l . ' ' , 20);
  }

  $subtotal = str_split($item['subtotal'], 10);
  foreach ($subtotal as $k => $l) {
    $l = trim($l);
    $subtotal[$k] = addSpaces(number_format($l, 2), 10);
  }
  $counter = 0;
  $temp = [];
  $temp[] = count($name_lines);
  $temp[] = count($subtotal);
  $counter = max($temp);

  for ($i = 0; $i < $counter; $i++) {
    $line = '';
    if (isset($name_lines[$i])) {
        $line .= ($name_lines[$i]);
    }
    if (isset($subtotal[$i])) {
        $line .= ($subtotal[$i]);
    }
    $printer->text($line . "\n");
  }
}
$printer -> feed(1);
$printer -> text("------------------------------ \n");
$printer -> text(addSpaces('ITEM QTY', 20) . addSpaces(number_format($totalQty), 10) . "\n\n");
$printer -> text(addSpaces('AMOUNT', 20) . addSpaces(number_format($totalAmount,2), 10) . "\n\n");
$printer -> text(addSpaces('VAT', 20) . addSpaces(number_format(0,2), 10) . "\n\n");
$printer -> text(addSpaces('DISCOUNT', 20) . addSpaces(number_format($totalDis,2), 10) . "\n\n");
$printer -> text(addSpaces('TOTAL', 20) . addSpaces(number_format($total,2), 10) . "\n\n");
$printer -> text("Tendered: \n\n");
$printer -> text(addSpaces('CASH', 20) . addSpaces(number_format($cash,2), 10) . "\n\n");
$printer -> text(addSpaces('CHANGE', 20) . addSpaces(number_format($change,2), 10) . "\n\n");
$printer -> feed(2);
$printer -> text("------------------------------ \n\n");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("Name: \t _______________\n\n");
$printer -> text("TIN/ID/SC: \t _______________\n\n");
$printer -> text("Address: \t _______________\n\n");
$printer -> text("Signature: \t _______________\n\n");
$printer -> text("\n\n\n\n");

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("THIS SERVES AS YOUR OFFICIAL RECEIPT\n\n");
$printer -> text("TinkerPro IT Solution\n\n");
$printer -> text("Gun-ob, Lapu-lapu City, Cebu\n\n");
$printer -> text("Website  : www.tinkerproPos.com\n\n");
$printer -> text("Mobile # : 09xxxxxxxxx\n\n");
$printer -> text("TIN #    : 000000-000000\n\n");
$printer -> feed(2);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("THIS IS NOT AN OFFICIAL RECEIPT\n");
$printer -> text("FOR DOCUMENTATION PURPOSES ONLY\n");
$printer -> cut();
$printer -> pulse();
$printer -> close();

header("Location: home.php?first_name=" . $firstName . "&last_name=" . $lastName);

?>