<?php
namespace App\Sistema;

class Config
{
	private $confFile = '.conf';
	private $config;
	
	public function __construct()
	{		
		$this->setConfig();
		
		define('PATH',$this->config['path']);
        define('APLICATION_PATH', WWW_ROOT .'/'. $this->config['appDir']);
	}
	private function setConfig()
	{
		
		$fConfig = json_decode(file_get_contents($this->confFile),true);
		$this->config = $fConfig;
	}
	public function getConfig($key = null)
	{
		if($key){
		    return $this->config[$key];
		}else{
			return $this->config;
		}
	}
}