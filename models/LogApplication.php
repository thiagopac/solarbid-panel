<?php

class LogApplication {

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

	public static function getAllLogApplications(){

		$DB = fnDBConn();

		$SQL = "SELECT
					LU.ID,
					LU.DESCRIPTION,
					LU.DIN
				FROM
					LOG_USER AS LU
				WHERE
					1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arr = [];

		foreach ($RESULT as $KEY => $ROW) {
			$obj = new LogApplication($ROW);
			array_push($arr, $obj);
		}

		return $arr;
	}

}
?>