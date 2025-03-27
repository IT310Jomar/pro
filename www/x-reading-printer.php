<?php 


// session_start();

require( __DIR__ . '../../vendor/autoload.php');
include( __DIR__ . '/layout/header.php');
include( __DIR__ . '/utils/db/connector.php');
include( __DIR__ . '/utils/models/shop-facade.php');
include( __DIR__ . '/utils/models/series-facade.php');
include( __DIR__ . '/utils/models/transaction-facade.php');
include( __DIR__ . '/utils/models/z-reading-facade.php');
include ( __DIR__ . '/barcode.php' );

use Mike42\Escpos;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;

use Mike42\Escpos\CapabilityProfiles\DefaultCapabilityProfile;
use Mike42\Escpos\CapabilityProfiles\SimpleCapabilityProfile;

    $jsonData = $_GET['returData'];
    $returData = json_decode($jsonData, true);

    function detectDefaultPrinter() {
        $command = 'powershell.exe -Command "Get-WmiObject -Query \"SELECT * FROM Win32_Printer WHERE Default=$true\" | ForEach-Object { $_.Name }"';
        $output = shell_exec($command);
        $defaultPrinter = trim($output);

        if (empty($defaultPrinter)) {
            throw new Exception("No default printer found.");
        }

        return $defaultPrinter;
    }



    $defaultPrinter = detectDefaultPrinter();

    $paperWidth = 80;
    $connector = new WindowsPrintConnector($defaultPrinter);
    $connector->write(Printer::GS.'L'.chr(0).chr(0));
    $connector->write(Printer::GS.'R'.chr(0).chr(0));

    $printer = new Printer($connector);
    $shopFacade = new ShopFacade;
    $seriesFacade = new SeriesFacade;
    $transactionFacade = new TransactionFacade;
    $z_reading = new ZReading;

    // $fetRestCount = $z_reading->resetZ_reading_report();
    // while ($rows = $fetRestCount ->fetch(PDO::FETCH_ASSOC)) {
    //     $resetCount = $rows['reset_count'];
    //     $z_coutn = $rows['z_read_count'];
    // }


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

    function addSpacesRight($text, $totalWidth) {
        return str_pad($text, $totalWidth, " ", STR_PAD_LEFT);
    }



    $currentDate = date("Y-m-d"); // Format: YYYY-MM-DD
    $current_time = date("H:i:s"); // Format: HH:MM:SS

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
    $printer -> text("$shopAddress \n");
    $printer -> text("CN: $contactNumber\n");
    $printer -> feed(2);
    $printer -> text("X-READING REPORT\n");
    $printer -> setEmphasis(false);
    $printer -> feed(3);

    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer -> text(addSpaces('Report Date:', $maxCharsPerLines) . addSpacesRight($currentDate, 10) . "\n");
    $printer -> text(addSpaces('Report Time:', $maxCharsPerLines) . addSpacesRight($current_time, 10) . "\n");
    $printer -> feed(1);
    $printer -> text(addSpaces('Start Date & Time:', $maxCharsPerLines) . addSpacesRight($currentDate, 10) . "\n");
    $printer -> text(addSpaces('End  Date & Time:', $maxCharsPerLines) . addSpacesRight($currentDate, 10) . "\n");

    $printer -> feed(3);
    
    $printer -> text(addSpaces("Beg. SI #:" , $maxCharsPerLines) . addSpacesRight($returData['beg_si'], 10) . "\n\n");
    $printer -> text(addSpaces("End. SI #:" , $maxCharsPerLines) . addSpacesRight($returData['end_si'], 10) . "\n\n");

    $printer -> text(addSpaces("Beg. VOID #:" , $maxCharsPerLines) . addSpacesRight($returData['void_beg'], 10) . "\n\n");
    $printer -> text(addSpaces("End. VOID #:" , $maxCharsPerLines) . addSpacesRight($returData['void_end'], 10) . "\n\n");

    $printer -> text(addSpaces("Beg. RETURN #:" , $maxCharsPerLines) . addSpacesRight($returData['return_beg'], 10) . "\n\n");
    $printer -> text(addSpaces("End. RETURN #:" , $maxCharsPerLines) . addSpacesRight($returData['return_end'], 10) . "\n\n");

    $printer -> text(addSpaces("Beg. REFUND #:" , $maxCharsPerLines) . addSpacesRight($returData['refund_beg'], 10) . "\n\n");
    $printer -> text(addSpaces("End. REFUND #:" , $maxCharsPerLines) . addSpacesRight($returData['refund_end'], 10) . "\n\n");

    $printer -> feed(5);
    $printer -> text(addSpaces("Reset Counter No." , $maxCharsPerLines) . addSpacesRight(number_format(0,2), 10) . "\n");
    $printer -> text(addSpaces("Z Counter No." , $maxCharsPerLines) . addSpacesRight(number_format(0,2), 10) . "\n");
    $printer->text(dynamicLine($maxCharsPerLine));
    $printer -> feed(2);
    $printer -> setEmphasis(true);
    $printer -> text(addSpaces("Items" , $maxCharsPerLines) . addSpacesRight('Amount(Php)', 10) . "\n");
    $printer -> setEmphasis(false);
    $printer -> feed(2);

    $printer -> text(addSpaces("Present Accumulated Sales:" , $maxCharsPerLines) . addSpacesRight(number_format($returData['present_accumulated_sale'],2), 10) . "\n");
    $printer -> text(addSpaces("Previous Accumulated Sales:" , $maxCharsPerLines) . addSpacesRight(number_format($returData['previous_accumulated_sale'],2), 10) . "\n");
    $printer -> text(addSpaces("Sales for the day:" , $maxCharsPerLines) . addSpacesRight(number_format($returData['totalSales'],2), 10) . "\n");

    $printer -> feed(2);
    $printer->text(dynamicLine($maxCharsPerLine));
    $printer -> feed(2);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> setEmphasis(true);
    $printer->text('BREAKDOWN OF SALES');
    $printer -> setEmphasis(false);
    $printer -> feed(2);


    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer -> text(addSpaces("VATABLE SALES" , $maxCharsPerLines) .addSpacesRight(number_format($returData['vatable_sales'],2), 10) . "\n");
    $printer -> text(addSpaces("VAT AMOUNT" , $maxCharsPerLines) .addSpacesRight(number_format($returData['vat_amount'],2), 10) . "\n");
    $printer -> text(addSpaces("VAT EXEMPT SALES" , $maxCharsPerLines) .addSpacesRight(number_format($returData['vat_exempt'],2), 10) . "\n");
    $printer -> text(addSpaces("ZERO RATED SALES" , $maxCharsPerLines) .addSpacesRight(number_format(0.00,2), 10) . "\n");
    $printer -> feed(2);
    $printer->text(dynamicLine($maxCharsPerLine));
    $printer -> feed(2);
    $printer -> text(addSpaces("Gross Amount" , $maxCharsPerLines) .addSpacesRight(number_format($returData['totalSales'],2), 10) . "\n");
    $printer -> text(addSpaces("Less Discount" , $maxCharsPerLines) . addSpacesRight(number_format($returData['less_discount'],2), 10) . "\n");
    $printer -> text(addSpaces("Less Return" , $maxCharsPerLines) . addSpacesRight(number_format($returData['less_return_amount'],2), 10) . "\n");
    $printer -> text(addSpaces("Less Void" , $maxCharsPerLines) . addSpacesRight(number_format($returData['less_void'],2), 10) . "\n");
    $printer -> text(addSpaces("Less VAT Adjsutment" , $maxCharsPerLines) . addSpacesRight(number_format($returData['less_vat_adjustment'],2), 10) . "\n");
    $printer -> text(addSpaces("Net Amount" , $maxCharsPerLines) . addSpacesRight(number_format($returData['net_amount'],2), 10) . "\n");

    $printer -> feed(2);
    $printer->text(dynamicLine($maxCharsPerLine));
    $printer -> feed(2);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> setEmphasis(true);
    $printer->text('DISCOUNT SUMMARY');
    $printer -> setEmphasis(false);
    $printer -> feed(2);

    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer -> text(addSpaces("SC Discount" , $maxCharsPerLines) . addSpacesRight(number_format($returData['senior_discount'],2), 10) . "\n");
    $printer -> text(addSpaces("UP Discount" , $maxCharsPerLines) . addSpacesRight(number_format($returData['officer_dis'],2), 10) . "\n");
    $printer -> text(addSpaces("PWD Discount" , $maxCharsPerLines) . addSpacesRight(number_format($returData['pwd_discount'],2), 10) . "\n");
    $printer -> text(addSpaces("NAAC Discount" , $maxCharsPerLines) . addSpacesRight(number_format($returData['naac_discount'],2), 10) . "\n");
    $printer -> text(addSpaces("SOLO PARENT Discount" , $maxCharsPerLines) . addSpacesRight(number_format($returData['solo_parent_discount'],2), 10) . "\n");
    $printer -> text(addSpaces("OTHER Discount" , $maxCharsPerLines) . addSpacesRight(number_format($returData['other_discount'],2), 10) . "\n");

    
    $printer -> feed(2);
    $printer->text(dynamicLine($maxCharsPerLine));
    $printer -> feed(2);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> setEmphasis(true);
    $printer->text('SALES ADJUSTMENT');
    $printer -> setEmphasis(false);
    $printer -> feed(2);

    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer -> text(addSpaces("VOID" , $maxCharsPerLines) . addSpacesRight(number_format($returData['void'],2), 10) . "\n");
    $printer -> text(addSpaces("RETURN" , $maxCharsPerLines) . addSpacesRight(number_format($returData['return'],2), 10) . "\n");
    $printer -> text(addSpaces("REFUND" , $maxCharsPerLines) . addSpacesRight(number_format($returData['refund'],2), 10) . "\n");


    $printer -> feed(2);
    $printer->text(dynamicLine($maxCharsPerLine));
    $printer -> feed(2);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> setEmphasis(true);
    $printer->text('VAT ADJUSTMENT');
    $printer -> setEmphasis(false);
    $printer -> feed(2);

    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer->text(addSpaces("SC VAT", $maxCharsPerLines) . addSpacesRight(number_format($returData['senior_citizen_vat'], 2), 10) . "\n");
    $printer->text(addSpaces("UP VAT", $maxCharsPerLines) . addSpacesRight(number_format($returData['officers_vat'], 2), 10) . "\n");
    $printer->text(addSpaces("PWD VAT", $maxCharsPerLines) . addSpacesRight(number_format($returData['pwd_vat'], 2), 10) . "\n");
    $printer->text(addSpaces("ZERO RATED VAT", $maxCharsPerLines) . addSpacesRight(number_format($returData['zero_rated'], 2), 10) . "\n");
    $printer->text(addSpaces("VAT. on RETURN", $maxCharsPerLines) . addSpacesRight(number_format($returData['vat_return'], 2), 10) . "\n");
    $printer->text(addSpaces("VAT. on REFUND", $maxCharsPerLines) . addSpacesRight(number_format($returData['vat_refunded'], 2), 10) . "\n");

    $printer -> feed(2);
    $printer->text(dynamicLine($maxCharsPerLine));
    $printer -> feed(2);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> setEmphasis(true);
    $printer->text('TRANSACTION SUMMARY');
    $printer -> setEmphasis(false);
    $printer -> feed(2);

    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer -> text(addSpaces("CASH IN DRAWER" , $maxCharsPerLines) . addSpacesRight(number_format($returData['cash_in_receive'],2), 10) . "\n");
    $printer -> text(addSpaces("CREDIT/DEBIT CARD" , $maxCharsPerLines) . addSpacesRight(number_format($returData['totalCcDb'],2), 10) . "\n");

    $printer -> text(addSpaces("E-WALLET" , $maxCharsPerLines) . addSpacesRight(number_format($returData['totalEwallet'],2), 10) . "\n");
    $printer -> text(addSpaces("COUPON" , $maxCharsPerLines) . addSpacesRight(number_format($returData['totalCoupon'],2), 10) . "\n");
    $printer -> text(addSpaces("CREDIT" , $maxCharsPerLines) . addSpacesRight(number_format($returData['credit'],2), 10) . "\n");

    $printer -> text(addSpaces("CASH IN" , $maxCharsPerLines) . addSpacesRight(number_format($returData['totalCashIn'],2), 10) . "\n");
    $printer -> text(addSpaces("CASH OUT" , $maxCharsPerLines) . addSpacesRight(number_format($returData['totalCashOut'],2), 10) . "\n");

    $printer -> text(addSpaces("PAYMENT RECEIVE" , $maxCharsPerLines) . addSpacesRight(number_format($returData['payment_receive'],2), 10) . "\n");

    $printer -> feed(5);

    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("Note: This is just a sample format. It may be changed by the taxpayer provided that all the required information are indicated in the taxpayer's format. \n");

    $printer -> feed(5);


    $printer -> cut();
    $printer -> pulse();
    $printer -> close();

