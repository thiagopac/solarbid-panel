<?php

class LogUser {

	public $id;
    public $description;
    public $din;
	public $userId;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['ID'];
            $this->description = $array['DESCRIPTION'];
			$this->din = $array['DIN'];
            $this->userId = $array['USER_ID'];
		}
  }

	public function __destruct(){

	}

	public static function getLogUserForUserId($userId){

		$DB = fnDBConn();

		$SQL = "SELECT
					LU.ID,
					LU.DESCRIPTION,
					LU.DIN,
					LU.USER_ID
				FROM
					LOG_USER AS LU
				WHERE
					LU.USER_ID = $userId";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$obj = new LogUser($RESULT);

		return $obj;
	}

	public static function getAllLogUsers($paramCountry){

		$DB = fnDBConn();

		$SQL = "SELECT
					LU.ID,
					LU.DESCRIPTION,
					LU.DIN,
					LU.USER_ID
				FROM
					LOG_USER AS LU
				WHERE
					1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arr = [];

		foreach ($RESULT as $KEY => $ROW) {
			$obj = new LogUser($ROW);
			array_push($arr, $obj);
		}

		return $arr;
	}

}
?>