<?php

class Currency {

	public $id;
	public $code;
	public $name;
	public $symbol;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['CURRENCY_ID'];
			$this->code = $array['CURRENCY_CODE'];
			$this->name = $array['CURRENCY_NAME'];
			$this->symbol = $array['CURRENCY_SYMBOL'];
		}
  }

	public function __destruct(){

	}

}
?>
