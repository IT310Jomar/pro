<?php

require __DIR__ . '../../vendor/autoload.php';

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;

use Picqer\Barcode\BarcodeGeneratorPNG;

$dateAndTime = date("Yhis");

function generateBarcode($text, $fileType = 'png', $outputFile = 'barcode')
{
    global $dateAndTime;
    $generator = new BarcodeGeneratorPNG();
    $imageData = $generator->getBarcode($text, $generator::TYPE_CODE_128);

    if (empty($imageData)) {
        echo "Error: Barcode generation failed.\n";
    } else {
        echo "Barcode generated successfully.\n";
    }
    $outputPath = __DIR__ . '/barcodes' . '/' . $outputFile . '_' . $dateAndTime . '.' . $fileType;
    file_put_contents($outputPath, $imageData);
    
    return $outputPath;
}

