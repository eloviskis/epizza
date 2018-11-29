<?php
namespace App\Sistema;
class Config
{
	private $config;
	
	public function __construct()
	{		
		$this->setConfig();
	}
	private function setConfig()
	{
		
		$fConfig = json_decode(file_get_contents('.conf'),true);
		$this->config = $fConfig;
	}
	public function getConfig()
	{
		return $this->config;
	}
}