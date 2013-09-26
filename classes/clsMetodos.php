<?php


class Metodos{
	
	
	
	
	public function Metodos(){
		
	}
	
	
	
	
	public function FormataValorRealParaGravar($valor){
		
		$valorTotal = str_replace('R$','',$valor);	   	   
		// Pega apenas as partes num�ricas
		$partes = array_filter(preg_split("/([\D])/", $valorTotal), 'strlen');	    
		// Separa a fra��o do inteiro
		$frac = count($partes) > 1 ? array_pop($partes) : "0";
		$inteiro = implode("", $partes);
		// Junta tudo, converte para ponto-flutuante e arredondanda
		$valorTotal = round((float) ($inteiro . "." . $frac), 2);
		
		return $valorTotal;
		
	}
	
	
	
	
	
	
	
	
	
	
	
}







?>