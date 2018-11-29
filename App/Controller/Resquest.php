<?php
namespace App\Controller;
use App\Sistema\Sistema;
use App\Sistema\Restricted;
class Resquest
{
	public function __construct()
	{
		$restricted = new Restricted;
		$sys = new Sistema;
		
		
		$sys->Token = $_SESSION['token'];
		echo "<pre>";
		print_r($sys->Request('admin/users','GET'));
		echo "</pre>";
	}
}