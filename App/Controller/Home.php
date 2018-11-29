<?php
namespace App\Controller;
use App\Sistema\Sistema;
use App\Sistema\Restricted;
class Home
{
	private $sys;
	public function __construct()
	{
		$restricted = new Restricted;
		
		$this->sys = new Sistema;
		$this->sys->Token = $_SESSION['token'];
		
		$this->setContent();
		$this->Render();
	}
	private function setContent()
	{	
		$this->sys->data['user']          = $this->sys->Request('admin/users/'.$_SESSION['userid'],'GET')->data;
		$this->sys->data['email']         = $this->sys->data['user']->email;
		$this->sys->data['message_title'] = "Bem vindo <b>".$this->sys->data['user']->name ."</b>";
		$this->sys->data['accounts']      = $this->sys->Accounts()->data->data;
		$this->sys->data['title']         = "Epizza Painel Adminstrativo";
		$this->sys->data['active']        = "dashboard";
		
	}
	private function Render(){
		$this->sys->View(array('template_header','home','template_footer'));
	}
}