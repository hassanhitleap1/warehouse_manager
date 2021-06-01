<?php
$data = 'otpauth://totp/test?secret=B3JX4VCVJDVNXNZ5&issuer=chillerlan.net';

// quick and simple:
echo '<img src="'.(new \chillerlan\QRCode\QRCode())->render($data).'" alt="QR Code" />';
?>