<?php
namespace App\Sistema;
class Restricted
{
	public function __construct()
	{
		session_start();
		
		if((isset($_SESSION['token'])) AND ($_SESSION['token'] != "")){
			
           $sys = new Sistema;
		   $sys->api_url = "http://api.epizzaonline.com.br/";
		   $sys->Token = $_SESSION['token'];
		   
		   if((isset($sys->Accounts()->error)) AND ($sys->Accounts()->error == "token_not_provided")){
			   header("Location:login");
			   exit();
		   }
		   if((isset($sys->Accounts()->error)) AND ($sys->Accounts()->error == "token_expired")){
			   header("Location:login/expired");
			   exit();
		   }
		   
		}else{
              header("Location:login");
			  exit();
		}
	}
}