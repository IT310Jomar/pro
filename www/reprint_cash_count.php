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

    if (isset($_GET["first_name"])) {
        $firstName = $_GET["first_name"];
    }
    if (isset($_GET["last_name"])) {
        $lastName = $_GET["last_name"];
    }

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


    $sample = $_GET['data'];
    $printData = [];
    foreach ($sample as $row) {
        if (isset($row['bills']) && isset($row['pcs']) && isset($row['subtotal_count'])) {
            $bills = $row['bills'];
            $qty = $row['pcs'];
            $totals = $row['subtotal_count'];

    
            $printData[] = array(
                'bills' => $bills,
                'qty' => $qty,
                'total' => $totals
            );
        }
    }

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
    $printer -> text("DUPLICATE CASH COUNT\n");
    $printer -> setEmphasis(false);
    $printer -> feed(3);

    $printer -> setJustification(Printer::JUSTIFY_LEFT); 
    $printer -> text("Terminal: " . getenv('COMPUTERNAME') . "\n"); 
    $printer -> text("Cashier: $firstName $lastName\n");
    $printer -> text("Date: $date\n");
    $printer -> text("Time: $time\n");
    $printer -> feed(1);

    function addSpacess($text, $width) {
        $textLength = strlen($text);
        $spacesNeeded = $width - $textLength;
        return $text . str_repeat(' ', $spacesNeeded);
    }

    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    $printer -> text(addSpacess("BILL(s)" , 20) . addSpacess('QTY', 20) . addSpacess('TOTAL', 20) ."\n");
    
    $totalCashIn = 0;
    for ($i = 0; $i < count($printData); $i++) {
        // $printer->text($printData[$i]['bills'] . $printData[$i]['qty'] . $printData[$i]['total'] . "\n");
        $totalCashIn += $printData[$i]['total'];
        $printer -> text(addSpacess(number_format($printData[$i]['bills'],2) , 20) . addSpacess($printData[$i]['qty'], 20) . addSpacess(number_format($printData[$i]['total'],2), 20) ."\n");
    }

    $printer -> feed(5);
    $printer -> text(addSpaces("TOTAL CASH", $maxCharsPerLines) . addSpacesRight(number_format($totalCashIn,2), 10) . "\n");
    $printer -> feed(5);

    $printer -> text("Approved By: __________________ \n");

    $printer -> feed(5);

    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("Note: This is just a sample format. It may be changed by the taxpayer provided \n");
    $printer -> text("that all the required information are indicated in the taxpayer's format. \n");

    $printer -> feed(5);


    $printer -> cut();
    $printer -> pulse();
    $printer -> close();


