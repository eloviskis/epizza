<?php
namespace App\Controller;
use App\Sistema\Sistema;
use App\Sistema\Restricted;
use App\Sistema\Date;
class Users
{
	private $sys;
	private $data = array();
	private $users;
	private $date;
	public function __construct()
	{
		
		$restricted = new Restricted;
		
		$this->sys = new Sistema;
		$this->sys->Token = $_SESSION['token'];
		
		$this->date = new Date;
		
		$this->setContent();
		$this->Render();
	}
	private function ListUsers()
	{
		$this->users = $this->sys->Request('admin/users','GET')->data;
		
		foreach($this->users as $key => $user){
			if($user->is_admin == 1){
			$return_user[$key]['id'] = $user->id;
			$return_user[$key]['name'] = $user->name;
			$return_user[$key]['email'] = $user->email;
			$return_user[$key]['created_at'] = $this->date->format_date($user->created_at);
			}
		}
		return $return_user;
		
	}
	private function setContent()
	{
		$this->sys->data['title'] = "Seus Dados - Epizza Painel Adminstrativo";
		$this->sys->data['message_title'] = "Usuários";
		$this->sys->data['active'] = "user";
		$this->sys->data['user']  = $this->sys->Request('admin/users/'.$_SESSION['userid'],'GET')->data;
		$this->sys->data['email'] = $this->sys->data['user']->email;
		$this->sys->data['name']  = $this->sys->data['user']->name;
		$this->sys->data['users'] = $this->ListUsers();
	}
	private function Render(){		
		$this->sys->View(array('template_header','users','template_footer'));
	}
}