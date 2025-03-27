<?php 

// session_start();

require( __DIR__ . '../../vendor/autoload.php');
include( __DIR__ . '/layout/header.php');
include( __DIR__ . '/utils/db/connector.php');
include( __DIR__ . '/utils/models/shop-facade.php');
include( __DIR__ . '/utils/models/series-facade.php');
include( __DIR__ . '/utils/models/transaction-facade.php');
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


function generateDivider($width) {
    $divLine = str_repeat('-', $width);
    return "$divLine\n";
}
// $defaultPrinter = detectDefaultPrinter();

// echo $defaultPrinter;

try {

  $paperWidth = 80;

  $defaultPrinter = detectDefaultPrinter();
  $connector = new WindowsPrintConnector($defaultPrinter);
  $connector->write(Printer::GS.'L'.chr(0).chr(0));
  $connector->write(Printer::GS.'R'.chr(0).chr(0));

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

  if (isset($_GET["user_id"])) {
    $cusId = $_GET["user_id"];
  }// receiptTransactionID

  if (isset($_GET["receiptTransactionID"])) {
    $reference_id = $_GET["receiptTransactionID"];
  }

  $transactions = $transactionFacade->getTotalByNum($transactionNum, $cusId)->fetchAll();
  $vat = $transactionFacade->getTotalVat($transactionNum, $cusId)->fetchAll();
  $payment_details = [];
  if($cusId == '6' || $cusId == 6) {
    foreach($vat as $data) {
      if($data['isVAT'] == 1) {
        $finalTotalSalesVat = $data['totalVatSales'];
        $finalVat = $data['VAT'];
      } else {
        $vatExempt = $data['VAT'];
        $fcustomerDis = $data['fcustomer_discount'];
      }
    }
    foreach($transactions as $transaction) {
      $total = $transaction['total'];
      $totalDis = $transaction['totalDis'];
      $totalQty = $transaction['totalQty'];
      $totalAmount = $transaction['totalAmount'];
      $cash = $transaction['payment_amount'];
      $change = $transaction['change_amount'];
      $vatAmount = $transaction['VAT'];
      $vatSales = $transaction['totalVatSales'];
      $toBePaid = $transaction['toBePaid'];

      $payment_details = $transaction['payment_details'];
    
      $custFname = $transaction['customer_fname'];
      $custLname = $transaction['customer_lname'];
      $customer_type = $transaction['customer_type'];
      $customerDisType = $transaction['customerDisType'];
      $regularDis = $transaction['regularDis'];
      $customerID = $transaction['customer_id'];
      $or_num = $transaction['or_num'];
      $receipt_barcode = $transaction['barcode'];

      $tempo_name = $transaction['temporary_name']; 
  }
    
  } else {
    foreach($vat as $data) {
      if($data['isVAT'] == 1) {
        $finalTotalSalesVat = $data['totalVatSales'];
        $finalVat = $data['VAT'];
      } else {
        $vatExempt = $data['VAT'];
        $fcustomerDis = $data['fcustomer_discount'];
      }
    }
    
    foreach($transactions as $transaction) {
      $total = $transaction['total'];
      $totalDis = $transaction['totalDis'];
      $totalQty = $transaction['totalQty'];
      $totalAmount = $transaction['totalAmount'];
      $cash = $transaction['payment_amount'];
      $change = $transaction['change_amount'];
      $vatAmount = $transaction['VAT'];
      $vatSales = $transaction['totalVatSales'];
      $toBePaid = $transaction['toBePaid'] + $fcustomerDis;
      $custFname = $transaction['customer_fname'];

      $payment_details = $transaction['payment_details'];

      $custLname = $transaction['cutomer_lname'];
      $customer_type = $transaction['customer_type'];
      $customerDisType = $transaction['customerDisType'];
      $customerID = $transaction['customer_id'];
      $finalDiscount = $transaction['fcustomer_discount'] - $fcustomerDis;
      $or_num = $transaction['or_num'];
      $receipt_barcode = $transaction['barcode'];

      $tempo_name = $transaction['temporary_name'];
    }
  }

  $barcodeImagePath = generateBarcode($receipt_barcode);
  $barcodeImage = EscposImage::load($barcodeImagePath);

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


if (strpos($defaultPrinter, "80")) {
  $maxCharsPerLine = 45; 
} else {
  $maxCharsPerLine = 30;  
}

$leftText = 'Item(s)';
$rightText = 'Subtotal(Php)';

function dynamicSpaces($leftText, $rightText, $maxCharsPerLine) {
  $totalLength = strlen($leftText) + strlen($rightText);
  $spaceLength = $maxCharsPerLine - $totalLength;
  return $leftText . str_repeat(' ', $spaceLength) . $rightText . "\n";
}


if (strpos($defaultPrinter, "80")) {
  $maxCharsPerLines = 37;
} else {
  $maxCharsPerLines = 22;  
}

function dynamicLine($maxCharsPerLines) {
  return str_repeat('-', $maxCharsPerLines) . "\n";
}

  // Print receipt
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> setEmphasis(true);
  $printer -> setLineSpacing(10);
  $printer -> text("$shopName\n\n");
  $printer -> text("Owned and Operated by: \n");
  $printer -> text("UNKNOWN \n");
  $printer -> text("GUN-OB LAPU-LAPU CITY, 6016 \n");
  $printer -> text("VAR REG TIN: XXX-XXX-XXX-XXX \n");
  $printer -> text("MIN: XXXXXXXXXXXXXXX \n");
  $printer -> text("S/N: XXX-XXX-XXX-XXX \n");
  $printer -> setEmphasis(false);
  // $printer -> text("$shopAddress \n");
  $printer -> text("CN: $contactNumber\n");
  $printer -> feed(1);
  $printer -> setEmphasis(true);
  $printer -> text("ORIGINAL\n");
  $printer -> setEmphasis(false);
  $printer -> feed(1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setEmphasis(true);
  $printer -> text("OR #: " . str_pad($or_num, 8, '0', STR_PAD_LEFT) . "\n");
  if($reference_id){
    $printer -> text("Reference No.: $reference_id\n");
  }
  $printer -> setEmphasis(false); 
  $printer -> text("Terminal: " . getenv('COMPUTERNAME') . "\n"); 
  $printer -> text("Trans #: $transactionNum\n");
  $printer -> text("Cashier: $firstName $lastName\n");
  $printer -> text("Date: $date\n");
  $printer -> text("Time: $time\n");
  $printer -> feed(1);
 
  if($tempo_name != '' || $tempo_name != null) {
    $printer -> text("Payer: $tempo_name\n");
  } else {
    $printer -> text("Payer: $custFname $custLname\n");
  }

  $printer -> text("Customer Type:  $customer_type\n");
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> feed(1);
  $printer -> setEmphasis(true);
  $printer -> text(dynamicSpaces($leftText, $rightText, $maxCharsPerLine));
  $printer -> setEmphasis(false);
  $printer -> text(dynamicLine($maxCharsPerLine));
  $printer -> feed(1);

  $items = $transactionFacade->getTransactionsByNum($transactionNum)->fetchAll();
  foreach ($items as $item) {
      // Current item ROW 1
      if($item['isVAT'] == 1) {
        $productDescription = str_split($item['prod_desc'] . ' (V)');
        if($item['discount_amount2'] == 0) {
          $name_lines = str_split($item['totalProdQty'] . ' x Php ' . number_format($item['prod_price'], 2) , 20);
        } else {
          $name_lines = str_split($item['totalProdQty'] . ' x Php ' . number_format($item['prod_price'], 2) . ' (-' . number_format($item['discount_amount2'],2) .')' , 40 );
        }
         
      } else {
  
        $productDescription = str_split($item['prod_desc'] . ' (V)');
        if($item['discount_amount2'] == 0) {
          $name_lines = str_split($item['totalProdQty'] . ' x Php ' . number_format($item['prod_price'], 2) , 20);
        } else {
          $name_lines = str_split($item['totalProdQty'] . ' x Php ' . number_format($item['prod_price'], 2) . ' (-' . number_format($item['discount_amount2'],2) .')' , 40 );
        }
      }

      
      $productDescLine = implode('', $productDescription);
      $printer->text($productDescLine . "\n\n");

      foreach ($name_lines as $k => $l) {
          $l = trim($l);
          $name_lines[$k] = addSpaces($l . ' ', $maxCharsPerLines);
      }
  
      $subtotal = str_split($item['totalSubtotal'], 10);
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
          $line1 = '';
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
  $printer -> text(addSpaces('ITEM QTY', $maxCharsPerLines) . addSpaces(number_format($totalQty), 10) . "\n");
  $printer -> text(addSpaces('AMOUNT', $maxCharsPerLines) . addSpaces(number_format($totalAmount,2), 10) . "\n");

  if($customerID != 6 || $customerID != '6') {
    $printer -> text(addSpaces(strtoupper($customer_type) . ' DISCOUNT', $maxCharsPerLines) . addSpaces(number_format($finalDiscount,2), 10) . "\n");
  } else {
    $printer -> text(addSpaces(strtoupper($customer_type) . ' DISCOUNT', $maxCharsPerLines) . addSpaces(number_format($regularDis,2), 10) . "\n");
  }

  $printer -> text(addSpaces('ITEM(s) DISCOUNT', $maxCharsPerLines) . addSpaces(number_format($totalDis,2), 10) . "\n");
  if($reference_id){
    $printer -> text(addSpaces('COUPON', $maxCharsPerLines) . addSpaces(number_format(0,2), 10) . "\n");
  }
  $printer -> setEmphasis(true);
  $printer -> text("\n");
  
   
  $text = addSpaces('TOTAL', $maxCharsPerLines) . addSpaces(number_format($toBePaid, 2), 10) . "\n";


  $printer -> setTextSize(1, 2);
  $printer -> text($text);
  $printer -> setTextSize(1, 1);

  $printer -> setEmphasis(false);
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> text("\n");
  $printer -> text("Tendered: \n");
  $printer -> text("\n");
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setEmphasis(true);

    if ($payment_details !== null) {
        $paymentDetailsArray = json_decode($payment_details, true);
        if ($paymentDetailsArray !== null) {
            foreach ($paymentDetailsArray as $paymentDetails) {
                $paymentType = strtoupper($paymentDetails['paymentType']);
                $amount = floatval($paymentDetails['amount']);
                $index = $paymentDetails['index'];
                if($amount != 0.00 || $amount != '0.00') {
                  $printer -> text(addSpaces($paymentType, $maxCharsPerLines) . addSpaces(number_format($amount,2), 10) . "\n");
                }
            }
        } else {
            echo "Error decoding payment details JSON string.";
        }
    } else {
        echo "Payment details are null or undefined.";
    }
 
  // $printer -> text(addSpaces('CASH', $maxCharsPerLines) . addSpaces(number_format($cash,2), 10) . "\n");
  // $printer -> text(addSpaces('COUPON', $maxCharsPerLines) . addSpaces(number_format(0,2), 10) . "\n");
  $printer -> text(addSpaces('CHANGE', $maxCharsPerLines) . addSpaces(number_format($change,2), 10) . "\n");
  $printer -> setEmphasis(false);

  $printer -> text("\n\n\n\n");

  if($customerID != 6 || $customerID != '6') {
    $printer -> text(addSpaces('Total Discount', $maxCharsPerLines) . addSpaces(number_format($totalDis + $finalDiscount,2), 10) . "\n");
  } else {
    $printer -> text(addSpaces('Total Discount', $maxCharsPerLines) . addSpaces(number_format($totalDis + $regularDis,2), 10) . "\n");
  }

  $printer -> text(addSpaces('VATable Sales(V)', $maxCharsPerLines) . addSpaces(number_format($finalTotalSalesVat,2), 10) . "\n");
  $printer -> text(addSpaces('VAT Amount', $maxCharsPerLines) . addSpaces(number_format($finalVat,2), 10) . "\n");
  $printer -> text(addSpaces('VAT Exempt', $maxCharsPerLines) . addSpaces(number_format($vatExempt,2), 10) . "\n");
  $printer -> text(addSpaces('Non VAT Sales', $maxCharsPerLines) . addSpaces(number_format(0.00,2), 10) . "\n");
  $printer -> feed(2);
  $printer -> text(dynamicLine($maxCharsPerLine));
  $printer -> setJustification(Printer::JUSTIFY_LEFT);


  if ($payment_details !== null) {
    $paymentDetailsArray = json_decode($payment_details, true);
    if ($paymentDetailsArray !== null) {
      foreach ($paymentDetailsArray as $paymentDetails) {
          $paymentType = strtoupper($paymentDetails['paymentType']);
          $amount = floatval($paymentDetails['amount']);
          $ref_num = $paymentDetails['ref_number'];
          $e_customer_name = $paymentDetails['e_customer_name'];
          if($amount != 0.00 || $amount != '0.00') {
            if($ref_num != '' || $ref_num != null) {
              // $printer -> text(". " . $e_customer_name . "\n");
              $printer -> text("Name: \t " . $e_customer_name ."\n\n");
            }
          }
      }
    } else {
        echo "Error decoding payment details JSON string.";
    }
  } else {
    $printer -> text("Name: \t _______________\n\n");
  }

 
  $printer -> text("TIN/ID/SC: \t _______________\n\n");
  $printer -> text("Address: \t _______________\n\n");
  $printer -> text("Signature: \t _______________\n\n");

  if ($payment_details !== null) {
    $paymentDetailsArray = json_decode($payment_details, true);
    if ($paymentDetailsArray !== null) {
        foreach ($paymentDetailsArray as $paymentDetails) {
            $paymentType = strtoupper($paymentDetails['paymentType']);
            $amount = floatval($paymentDetails['amount']);
            $ref_num = $paymentDetails['ref_number'];
            if($amount != 0.00 || $amount != '0.00') {
              if($ref_num != '' || $ref_num != null) {
                $printer -> setEmphasis(true);
                $printer -> text("Ref No. " . $ref_num . "\n\n");

                if($paymentDetails['customer_accountNum']) {
                  $accountNumber = $paymentDetails['customer_accountNum'];
                  $lastFourDigits = substr($accountNumber, -4);
                  $printer -> text("Card Ending. " . $lastFourDigits . "\n\n");
                }
                $printer -> setEmphasis(false);
              }
            }
        }
  
        
    } else {
        echo "Error decoding payment details JSON string.";
    }
  } else {
      echo "Payment details are null or undefined.";
  }

  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> feed(1);
  $printer->bitImageColumnFormat($barcodeImage, Printer::IMG_DOUBLE_WIDTH | Printer::IMG_DOUBLE_HEIGHT);

  // $printer->text($receipt_barcode . " \n");

  $printer -> feed(1);
  $printer -> text("    \n");
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  // $printer -> text("THIS SERVES AS YOUR OFFICIAL RECEIPT\n");
  $printer -> text("THIS IS NOT AN OFFICIAL RECEIPT\n");
  $printer -> text("FOR DOCUMENTATION PURPOSES ONLY\n\n");
  $printer -> text("TinkerPro IT Solution\n");
  $printer -> text("Gun-ob, Lapu-lapu City, Cebu\n");
  $printer -> text("Website: www.tinkerproPos.com\n");
  $printer -> text("Mobile #: 09xxxxxxxxx\n");
  $printer -> text("TIN #: 000000-000000\n");
  unlink($barcodeImagePath);
  // $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> setLineSpacing(20);
  $printer -> cut();
  $printer -> feed(10);
  $printer -> pulse();
  $printer -> close();


}  catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

