<?php
namespace App\Controller;
use App\Sistema\Sistema;
class Login
{
	private $user_email;
	private $user_pass;
	private $response_login;
	private $sys;
	private $data = array();
	private $userData = array();
	private $acessToken;
	
	public function __construct()
	{
		session_start();
		$this->sys = new Sistema;
        $this->Page();		
		$this->Logout();
		if(!$this->setLogin()) $this->Render();
	}
	private function setCredecials()
	{
		if(isset($_POST['username'])){
			
			$this->user_email = $_POST['username'];
			$this->user_pass = $_POST['password'];
			
			return true;
		}
		
	}
	private function setLogin()
	{
		if($this->setCredecials()){
			
			$this->sys->user_email = $this->user_email;
		    $this->sys->user_pass  = $this->user_pass;
			
			$this->response_login = $this->sys->Login();
			
			if(($this->response_login->data) AND ($this->response_login->data->token)){
				
				$this->acessToken = $this->response_login->data->token;
				$this->sys->Token = $this->acessToken;
				$this->userData = $this->sys->Request('admin/users','GET')->data ;
				foreach($this->userData as $userReturn){					
					if($userReturn->email == $this->user_email){	
                        $this->userData = $userReturn->id;						
					}
					
				}
				$_SESSION['userid'] = $this->userData;
				$_SESSION['token'] = $this->acessToken;
				header("Location:/");
				
			}else{
				
				  $this->data['error'] = "<b> Algo Errado - </b> Verique os dados e tente novamente!</span>";
                  $this->Render();			
			}
			
			return $this->sys->Login();
		}
	}
	private function Page()
	{
		if($this->sys->getParameter()){
			
			if($this->sys->getParameter() == 'expired'){
				$this->data['error'] = "<b> Ops - </b> Sua sessão expirou, tente se logar novamente!</span>";
			}
			
		}
	}
	private function Logout()
	{
		if(($this->sys->getParameter()) AND ($this->sys->getParameter() == "logout")){
			session_unset();
			header("Location:/");
		}
	}
	private function Render()
	{
		$page = $this->data;
		include "App/View/login.php";
	}
}