<?php

class LogServer {

	public $id;
    public $description;
    public $din;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['ID'];
            $this->description = $array['DESCRIPTION'];
			$this->din = $array['DIN'];
		}
  }

	public function __destruct(){

	}

}
?>