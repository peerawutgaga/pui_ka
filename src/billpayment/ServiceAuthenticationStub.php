<?php

class ServiceAuthenticationStub
{
    public static function accountAuthenticationProvider( $accNo )
	{
		$mockUpAccountNumber=1234567890;
		$mockUpAccountName="Pui";
		$mockUpAccountBalance=500;
		$mockUpErrorString="account not found";
		$isError=false;
		
		if( !$isError )
		{
			return array('accNo'=>$accNo, 'accName'=>$mockUpAccountName, 'accBalance'=>$mockUpAccountBalance);
		}
		else
		{
			return AccountInformationException("Account number : {$accNo} not found.");
		}
    }    
}

?>