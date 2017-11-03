<?php

require_once "../vendor/autoload.php";

use Charge\Charge;

$accountNumber = $_POST['accountNumber'];
$chargeType = $_POST['chargeType'];

$chargeAmount = new Charge($accountNumber,$chargeType);
echo json_encode($chargeAmount->getCharge()); 



