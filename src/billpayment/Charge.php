<?php

require_once 'DBConnection.php';

class Charge{
	
    public static function getCharge( $accountNumber,  $serviceType )
	{		
		$account = DBConnection::getCharge($accountNumber, $serviceType);		
		return $account;
    }
}

?>