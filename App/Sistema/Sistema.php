<?php
namespace App\Sistema;
class Sistema
{
	private $url;
	private $exploder;
	private $controller;
	public $api_url;
	private $endpoint;
	public $Token;
	public $user_email;
	public $user_pass;
	public $labels;
	private $method;
	private $reponse;
    private $headers;
	private $parameters = false;
	public $data;
	public $config;
    
	public function __construct()
	{
		$this->config = new Config;
		$this->api_url = $this->config->getConfig()['Api_url'];
		$this->setUrl();
		$this->setExploder();
		$this->setParameter();
	}
	
	private function setUrl()
	{
		$this->url = $_SERVER ['REQUEST_URI'];
	}
	private function setExploder()
	{
		//$this->url = str_replace('/', '' , $this->url );
		$this->exploder = explode('/',$this->url);
	}
	private function setHeader()
	{
		$this->headers = array(
		array("Content-type: application/json"),
		array("Authorization: Bearer ".$this->Token ),
		array("Authorization: Bearer ".$this->Token , "Content-type: application/json"),
		array("Authorization: Bearer ".$this->Token , "Content-Type: text/plain; charset=utf-8")
		);
	}
	private function requset_api()
	{			
			$curl = curl_init($this->api_url . $this->endpoint);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->method );
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers );
			if($this->labels) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $this->labels ));
			$this->reponse = curl_exec($curl);

			$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			/*if ( $status > 350 ) {
				die("Error: call to URL ". $this->api_url ." failed with status $status, response ". $this->reponse .", curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
			}*/


			curl_close($curl);
	}
	public function Login()
	{
		$this->setHeader();
		$this->endpoint = 'admin/auth/signin';
		$this->headers  = $this->headers[0];
		$this->labels   = array(
			'email'    => $this->user_email ,
			'password' => $this->user_pass
		);
		$this->method = "POST";
		$this->requset_api();
		
		return json_decode($this->reponse);
	}
	public function Accounts($mode = false,$endpoint_add = false){
		$this->setHeader();
		$this->endpoint = 'admin/accounts';
		$this->endpoint = ($endpoint_add) ? $this->endpoint . $endpoint_add : $this->endpoint;
		$this->headers  = $this->headers[2];
		$this->method = ($this->labels) ? "POST" : "GET";
		$this->method = ($mode) ? $mode : $this->method;
		
		$this->requset_api();
		
		return json_decode($this->reponse);
	}
	public function Request($endpoint,$mode = false,$header_add = false){
		$this->setHeader();
		$this->endpoint = $endpoint;
		$this->headers  = ($header_add) ? $this->headers[$header_add] : $this->headers[2];
		$this->method = ($this->labels) ? "POST" : "GET";
		$this->method = ($mode) ? $mode : $this->method;
		
		$this->requset_api();
		
		return json_decode($this->reponse);
	}
	public function View($nameViews){
		
		$page = $this->data;
		
		foreach($nameViews as $nameView){
		include "App/View/".$nameView.".php";
		}
	}
    private function setParameter()
	{
	    if((isset($this->exploder[2])) AND ($this->exploder[2] !=  "" )){
			$this->parameters =  mb_strtolower($this->exploder[2]);
		}
	}
	public function getParameter()
	{
		if($this->parameters) return $this->parameters;
	}
	public function Run()
	{
		
		
		if((isset($this->exploder[1])) AND ($this->exploder[1] != "")){
			$this->exploder[1] = mb_strtolower($this->exploder[1]);
			$this->exploder[1] = ucfirst($this->exploder[1]);
			$this->controller = "App\\Controller\\".$this->exploder[1];
		}else{
			$this->controller = "App\\Controller\\Home";
		}
		$this->controller = new $this->controller();
	}
}