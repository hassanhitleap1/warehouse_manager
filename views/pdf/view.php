<?php

use Endroid\QrCode\QrCode;

$qrCode = new QrCode();
header('Content-Type: '.$qrCode->getContentType());
// or create a response object
$response = new Response($qrCode->get(), 200, array('Content-Type' => $qrCode->getContentType()));
print_r($qrCode->getContentType());
exit();
$qrCode
    ->setText('Life is too short to be generating QR codes')
    ->setSize(300)
    ->setPadding(10)
    ->setErrorCorrection('high')
    ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
    ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
    ->setLabel('Scan the code')
    ->setLabelFontSize(16)
    ->setImageType(QrCode::IMAGE_TYPE_PNG)
;
print_r($qrCode);
exit();

// now we can directly output the qrcode
header('Content-Type: '.$qrCode->getContentType());
$qrCode->render();

// or create a response object
$response = new Response($qrCode->get(), 200, array('Content-Type' => $qrCode->getContentType()));
