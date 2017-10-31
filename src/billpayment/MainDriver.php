<?php 

require('ServiceType.php');
require('BillPayment.php');

class MainDriver 
{
    public static function payBill() 
	{ 
		Billing::payBill( ServiceType::ELECTRIC_BILLING, '4235750021' );        
    }
};

//	Call driver to pay bill
MainDriver::payBill();