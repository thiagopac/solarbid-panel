<?php

class Language {

	public $id;
	public $code;
	public $name;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['LANGUAGE_ID'];
			$this->code = $array['LANGUAGE_CODE'];
			$this->name = $array['LANGUAGE_NAME'];
		}
  }

	public function __destruct(){

	}

}
?>
