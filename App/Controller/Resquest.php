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
		
		/*$sys->user_email = 'wlproducoes@gmail.com';
		$sys->user_pass  = 'mdm070911';*/
		
		/*$sys->labels = array(
		'email' => 'wlproducoes@gmail.com',
		'password' => 'mdm070911',
		'name' => 'Danilo Pastor',
		'role' => '1',
		'password_confirmation' => 'mdm070911'
		);*/
		
		$sys->Token = $_SESSION['token'];
		echo "<pre>";
		print_r($sys->Request('admin/users','GET'));
		echo "</pre>";
	}
}