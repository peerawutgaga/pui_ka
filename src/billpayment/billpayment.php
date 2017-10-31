<?php

require_once 'AccountInformationException.php';
require_once 'BillingException.php';
require_once 'ServiceAuthentication.php';
require_once 'ServiceAuthenticationStub.php';
require_once 'Charge.php';
require_once 'ChargeStub.php';
require_once 'DBConnection.php';

class Billing
{
	
    public static function payBill( $serviceType, $accNo )
	{    
		DBConnection::restore();
		
		//	It's stub.
        //$account = ServiceAuthenticationStub::accountAuthenticationProvider( $accNo );
		$account = ServiceAuthentication::accountAuthenticationProvider( $accNo );
				
        if(count($account)==1)
        {
            throw new AccountInformationException("Account number : {$accNo} not found.");
        }
		
		// // It's real
        //$amount = DBConnection::getCharge($accNo, $serviceType);
		
		// It's stub.
		//$amount = ChargeStub::getCharge( $accNo, $serviceType );
		$amount = Charge::getCharge( $accNo, $serviceType );
				
        if( $account['accBalance'] < $amount )
        {
            throw new BillingException("Balance is not enough");
        }
        if($amount<0)
        {
            throw new BillingException("Charge invalid");
        }
        if($amount==0)
        {
            throw new BillingException("You don't have a bill to pay");
        }
        
		DBConnection::saveTransaction($accNo, ($account['accBalance']-$amount));
		
		$account = ServiceAuthentication::accountAuthenticationProvider($accNo); 
		
		DBConnection::restore();
		
		echo $account['accBalance'];
		
        return $account;
    }
}
?>