<?php 

require('ServiceType.php');
require('billpayment.php');

class MainDriver 
{
    public static function pay() 
	{ 
		BillPayment::pay( ServiceType::ELECTRIC_BILLING, '4235750021' );        
    }
};

//	Call driver to pay bill
MainDriver::pay();