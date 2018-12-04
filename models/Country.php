<?php

class Country {

	public $id;
    public $description;
	public $code;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['ID'];
			$this->code = $array['CODE'];
			$this->description = $array['DESCRIPTION'];
		}
  }

	public function __destruct(){

	}

}
?>
