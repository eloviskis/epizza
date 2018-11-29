<?php
namespace App\Sistema;
class Date
{
	private $date;
	private $moth;
	public function format_date($date)
	{
		$this->date = $date;
		
		$this->date = explode(" ", $this->date);
		$this->date = explode("-",$this->date[0]);
		
		/*$moth = array(
		01 => 'Janeiro',
		02 => 'Fevereiro',
		03 => 'Março',
		04 => 'Abril',
		05 => 'Maio',
		06 => 'Junho',
		07 => 'Julho',
		08 => 'Agosto',
		09 => 'Setembro',
		10 => 'Outubro',
		11 => 'Novembro',
		12 => 'Dezembro'
		);*/
		
		$this->date = $this->date[2]." de ".$this->Moth($this->date[1])." de ".$this->date[0];
		
		return $this->date;
	}
	private function Moth($key)
	{
		$this->moth = array(
		'01' => 'Janeiro',
		'02' => 'Fevereiro',
		'03' => 'Março',
		'04' => 'Abril',
		'05' => 'Maio',
		'06' => 'Junho',
		'07' => 'Julho',
		'08' => 'Agosto',
		'09' => 'Setembro',
		'10' => 'Outubro',
		'11' => 'Novembro',
		'12' => 'Dezembro'
		);
		
		return $this->moth[$key];
	}
}