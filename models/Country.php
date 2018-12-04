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

	public function getCountryWithID($param){

		$DB = fnDBConn();

		$SQL = "SELECT
							CNT.ID,
							CNT.DESCRIPTION,
							CNT.CODE
						FROM
							COUNTRY AS CNT
						WHERE
							CNT.ID = $param";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$obj = new Country($RESULT);

		return $obj;
	}

	public function getAllCountries($paramCountry){

		$DB = fnDBConn();

		$SQL = "SELECT
							CNT.ID,
							CNT.DESCRIPTION,
							CNT.CODE
						FROM
							COUNTRY AS CNT
						WHERE
							1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arr = [];

		foreach ($RESULT as $KEY => $ROW) {
			$obj = new Country($ROW);
			array_push($arr, $obj);
		}

		return $arr;
	}

}
?>
