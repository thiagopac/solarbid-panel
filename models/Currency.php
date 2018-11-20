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

	public function getCurrencyWithID($paramCurrency){

		$DB = fnDBConn();

		$SQL = "SELECT
							CUR.ID AS CURRENCY_ID,
							CUR.CODE AS CURRENCY_CODE,
							CUR.NAME AS CURRENCY_NAME,
							CUR.SYMBOL AS CURRENCY_SYMBOL
						FROM
							CURRENCY AS CUR
						WHERE
							CUR.ID = $paramCurrency";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$currency = new Currency($RESULT);

		return $currency;
	}

	public function getAllCurrencies(){

		$DB = fnDBConn();

		$SQL = "SELECT
							CUR.ID AS CURRENCY_ID,
							CUR.CODE AS CURRENCY_CODE,
							CUR.NAME AS CURRENCY_NAME,
							CUR.SYMBOL AS CURRENCY_SYMBOL
						FROM
							CURRENCY AS CUR
						WHERE
							1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arrCurrencies = [];

		foreach($RESULT as $KEY => $ROW){
			$currency = new Currency($ROW);
			array_push($arrCurrencies, $currency);
		}

		return $arrCurrencies;
	}

}
?>
