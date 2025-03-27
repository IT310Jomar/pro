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
  $seriesFacade = new SeriesFacade;

  

  

  $payment_id = isset($_GET['payment_id']) ? $_GET['payment_id'] : null;

  if (isset($_GET["first_name"])) {
    $firstName = $_GET["first_name"];
  }
  if (isset($_GET["last_name"])) {
    $lastName = $_GET["last_name"];
  }

  if (isset($_GET["user_id"])) {
    $cusId = $_GET["user_id"];
  }


  $refunds = $refundTransactions->getRefundedData($payment_id);


  if (isset($refunds) && !empty($refunds)) {
      echo json_encode([
          'success' => true,
          'refunded' => $refunds
      ]);
      // You can proceed with your logic here since $refunds contains data
  } else {
      echo json_encode([
          'success' => false,
          'message' => 'No refunded transactions found.'
      ]);
      // Handle the case where no data is found in $refunds
  }

 
 

  $totalVatSalesSum = 0;
  $totalVat = 0;
  if($cusId == '6' || $cusId == 6) {
    foreach($refunds as $transaction) {
      $ref_no = $transaction['ref_num'];
      $refunded_no = $transaction['refund_num'];
      $custFname = $transaction['first_name'];
      $custLname = $transaction['last_name'];
      $customer_type =  $transaction['discountType'];
      $method =  $transaction['method'];
      $totalVatSalesSum += $transaction['totalVatSales'];
      $totalVat += $transaction['VAT'];
      
    }
   
    
  } else {
    foreach($refunds as $transaction) {
      $ref_no = $transaction['ref_num'];
      $refunded_no = $transaction['refund_num'];
      $custFname = $transaction['first_name'];
      $custLname = $transaction['last_name'];
      $customer_type =  $transaction['discountType'];
      $method =  $transaction['method'];
      $totalVatSalesSum += $transaction['totalVatSales'];
      $totalVat += $transaction['VAT'];
    }
   
  }

  if($method == 1){
    $methodType = 'Cash';
  }else if($method == 7){
    $methodType = 'Voucher';
  }else if($method == 2){
    $methodType = 'GCash';
  }else if($method == 3){
    $methodType = 'Pay Maya';
  }else if($method == 4){
    $methodType = 'Grab Pay';
  }else if($method == 8){
    $methodType = 'Ali Pay';
  }else if($method == 9){
    $methodType = 'Shopee Pay';
  }else if($method == 5){
    $methodType = 'Visa';
  }else if($method == 6){
    $methodType = 'Master Card';
  }else if($method == 10){
    $methodType = 'Discover';
  }else if($method == 11){
    $methodType = 'American Express';
  }else if($method == 12){
    $methodType = 'JCB';
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
  function addSpaces($string = '', $valid_string_length = 0) {
    if (strlen($string) < $valid_string_length) {
      $spaces = $valid_string_length - strlen($string);
      for ($index1 = 1; $index1 <= $spaces; $index1++) {
        $string = $string . ' ';
      }
    }
    return $string;
  
  }
  if (strpos($defaultPrinter, "80")) {
    $maxCharsPerLine = 45; 
  }else{
    $maxCharsPerLine = 30;  
  }
 
  $leftText = 'Item(s)';
  $rightText = 'Subtotal';

  function dynamicSpaces($leftText, $rightText, $maxCharsPerLine) {
    $totalLength = strlen($leftText) + strlen($rightText);
    $spaceLength = $maxCharsPerLine - $totalLength;
    return $leftText . str_repeat(' ', $spaceLength) . $rightText . "\n";
  }


if (strpos($defaultPrinter, "80")) {
  $maxCharsPerLines = 37;
}else{
  $maxCharsPerLines = 22;  
}

function dynamicLine($maxCharsPerLines) {
  return str_repeat('-', $maxCharsPerLines) . "\n";
}


 
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
  // $printer -> text("$shopAddress \n");
  $printer -> text("CN: $contactNumber\n");//ok
  $printer -> feed(1);
  $printer -> setEmphasis(true);
  $printer -> text("REFUND RECEIPT\n");//OK
  $printer -> setEmphasis(false);
  $printer -> feed(1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setEmphasis(true);
  $printer -> text("Refund #: " . str_pad($refunded_no, 8, '0', STR_PAD_LEFT) . "\n");//ok
  $printer -> text("Reference #: " . str_pad($ref_no, 8, '0', STR_PAD_LEFT) . "\n");//ok
  $printer -> setEmphasis(false); 
  $printer -> text("Terminal: " . getenv('COMPUTERNAME') . "\n"); //ok
  $printer -> text("Cashier: $firstName $lastName\n");//ok
  $printer -> text("Date: $date\n");//ok
  $printer -> text("Time: $time\n");//ok
  $printer -> text("Payer: $custFname $custLname\n"); //ok
  $printer -> text("Customer Type:  $customer_type\n");//ok
  $printer -> setEmphasis(true);
  $printer -> text("Refund Type: $methodType \n");//ok
  $printer -> setEmphasis(false); 
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> feed(1);
  $printer -> setEmphasis(true);
  $printer->text(dynamicSpaces($leftText, $rightText, $maxCharsPerLine));
  $printer -> setEmphasis(false);
  $printer->text(dynamicLine($maxCharsPerLine));
  $printer -> feed(1);




foreach ($refunds as $item) {
    if($item['isVAT'] == 1) {
      $totalLength = 40;
      $productDescription = str_split($item['prod_desc'] . ' (V)');
      $name_lines =  str_split($item['qty'] . ' x Php ' . number_format($item['prod_price'], 2) , 40);
  } else {
      $productDescription = str_split($item['prod_desc'] . ' (N)');
      $name_lines = str_split($item['qty'] . ' x Php '.number_format($item['prod_price'], 2), 40);
  }

  $productDescLine = implode('', $productDescription);
  $printer->text($productDescLine . "\n\n");

    foreach ($name_lines as $k => $l) {
      $l = trim($l);
      $name_lines[$k] = addSpaces($l . ' ' ,  $maxCharsPerLines);
    }

    $subtotal = str_split($item['totalSubtotal'], 10);
    foreach ($subtotal as $k => $l) {
      $l = trim($l);
      $subtotal[$k] = addSpaces(number_format($l, 2), 10);
    }
    $totalRefunded += $item['totalSubtotal'];
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
  $printer->text(dynamicLine($maxCharsPerLine));
  $printer->text(addSpaces('TOTAL REFUND', $maxCharsPerLines) . addSpaces(number_format($totalRefunded, 2), 10) . "\n");
  $printer -> feed(2);
  $printer->text(dynamicLine($maxCharsPerLine));

  $printer -> text("\n\n\n\n\n\n");

  $printer -> text(addSpaces('VATable Sales(V)', $maxCharsPerLines) . addSpaces(number_format( $totalVatSalesSum ,2), 10) . "\n");
  $printer -> text(addSpaces('VAT Amount', $maxCharsPerLines) . addSpaces(number_format($totalVat,2), 10) . "\n");
  $printer -> text(addSpaces('VAT Exempt', $maxCharsPerLines) . addSpaces(number_format($vatExempt,2), 10) . "\n");
  $printer -> feed(2);
  $printer->text(dynamicLine($maxCharsPerLine));

  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> text("Name: \t _______________\n\n");
  $printer -> text("TIN/ID/SC: \t _______________\n\n");
  $printer -> text("Address: \t _______________\n\n");
  $printer -> text("Signature: \t _______________\n\n");
  $printer -> text("       \n\n");

  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> feed(1);
  $printer -> feed(1);
  $printer -> text("    \n");
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> text("THIS IS NOT AN OFFICIAL RECEIPT\n");
  $printer -> text("FOR DOCUMENTATION PURPOSES ONLY\n\n");
  $printer -> text("TinkerPro IT Solution\n");
  $printer -> text("Gun-ob, Lapu-lapu City, Cebu\n");
  $printer -> text("Website: www.tinkerproPos.com\n");
  $printer -> text("Mobile #: 09xxxxxxxxx\n");
  $printer -> text("TIN #: 000000-000000\n");

  $printer -> setLineSpacing(20);
  $printer -> cut();
  $printer -> feed(10);
  $printer -> pulse();
  $printer -> close();
 
} catch (Exception $e) {
  
  echo "Error: " . $e->getMessage();
}