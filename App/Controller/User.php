<?php
namespace App\Controller;
use App\Sistema\Sistema;
use App\Sistema\Restricted;
class User
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
		
		$this->sys->data['title']         = "Seus Dados - Epizza Painel Adminstrativo";
		$this->sys->data['message_title'] = "Meus Dados";
		$this->sys->data['user']          = $this->sys->Request('admin/users/'.$_SESSION['userid'],'GET')->data;
		$this->sys->data['email']         = $this->sys->data['user']->email;
		$this->sys->data['name']          = $this->sys->data['user']->name;
		
		
	}
	private function Render(){		
		$this->sys->View(array('template_header','user','template_footer'));
	}
}