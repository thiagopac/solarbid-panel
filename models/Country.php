<?php

class Country {

	public $id;
	public $code;
	public $name;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['COUNTRY_ID'];
			$this->code = $array['COUNTRY_CODE'];
			$this->name = $array['COUNTRY_NAME'];
		}
  }

	public function __destruct(){

	}

	public function getCountryWithID($paramCountry){

		$DB = fnDBConn();

		$SQL = "SELECT
							CNT.ID AS COUNTRY_ID,
							CNT.CODE AS COUNTRY_CODE,
							CNT.NAME AS COUNTRY_NAME
						FROM
							COUNTRY AS CNT
						WHERE
							CNT.ID = $paramCountry";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$country = new Country($RESULT);

		return $country;
	}

	public function getAllCountries($paramCountry){

		$DB = fnDBConn();

		$SQL = "SELECT
							CNT.ID AS COUNTRY_ID,
							CNT.CODE AS COUNTRY_CODE,
							CNT.NAME AS COUNTRY_NAME
						FROM
							COUNTRY AS CNT
						WHERE
							1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arrCountries = [];

		foreach ($RESULT as $KEY => $ROW) {
			$country = new Country($ROW);
			array_push($arrCountries, $country);
		}

		return $arrCountries;
	}

}
?>
