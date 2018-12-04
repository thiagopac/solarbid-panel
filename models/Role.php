<?php

class Role {

	public $id;
	public $description;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['ID'];
			$this->description = $array['DESCRIPTION'];
		}
  }

	public function __destruct(){

	}

	public function getRoleWithID($param){

		$DB = fnDBConn();

		$SQL = "SELECT
					RO.ID,
					RO.DESCRIPTION
				FROM
					ROLE AS RO
				WHERE
					RO.ID = $param";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$obj = new Role($RESULT);

		return $obj;
	}

	public function getAllRoles(){

		$DB = fnDBConn();

		$SQL = "SELECT
					RO.ID,
					RO.DESCRIPTION
				FROM
					ROLE AS RO
				WHERE
					1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arr = [];

		foreach ($RESULT as $KEY => $ROW) {
			$obj = new Role($ROW);
			array_push($arr, $obj);
		}

		return $arr;
	}

}
?>
