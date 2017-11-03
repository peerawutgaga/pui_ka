<?php

require_once 'AccountInformationException.php';
require_once 'BillingException.php';
require_once 'ServiceAuthentication.php';
require_once 'ServiceAuthenticationStub.php';
require_once 'Charge.php';
require_once 'ChargeStub.php';
require_once 'DBConnection.php';

class BillPayment
{
	
    public static function pay( $serviceType, $accNo )
	{    
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
        Charge::clearCharge($accNo, $serviceType);
		
		$account = ServiceAuthentication::accountAuthenticationProvider($accNo); 
		
		echo $account['accBalance'];
		
        return $account;
    }
    public function resetDatabase()
    {
        DBConnection::restore();           
    }
}
?>
