<?php

class Audit {

	public $id;
    public $userId;
	public $ip;
	public $actionDesc;
	public $din;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['ID'];
            $this->userId = $array['USER_ID'];
			$this->ip = $array['IP'];
			$this->actionDesc = $array['ACTION_DESC'];
			$this->din = $array['DIN'];
		}
  }

	public function __destruct(){

	}

	public function getAuditWithID($param){

		$DB = fnDBConn();

		$SQL = "SELECT
					AUD.ID,
					AUD.ID_USER AS USER_ID,
					AUD.IP,
					AUD.ACTION_DESC,
					AUD.DIN
				FROM
					AUDIT AS AUD
				WHERE
					AUD.ID = $param
				ORDEY BY
					AUD.DIN DESC";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$obj = new Audit($RESULT);

		return $obj;
	}

	public function getAllAudits(){

		$DB = fnDBConn();

		$SQL = "SELECT
					AUD.ID,
					AUD.ID_USER AS USER_ID,
					AUD.IP,
					AUD.ACTION_DESC,
					AUD.DIN
				FROM
					AUDIT AS AUD
				WHERE
					1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arr = [];

		foreach ($RESULT as $KEY => $ROW) {
			$obj = new Audit($ROW);
			array_push($arr, $obj);
		}

		return $arr;
	}

    public static function insertAudit($param){
        $DB = fnDBConn();

        $userId = "";
        $ip = "";
        $actionDesc = "";

        //tratamento para aceitar objetos ou arrays como parâmetro
        if ($param->userId != null){
            $userId = $param->userId;
        }else{
            $userId = $param["userId"];
        }

        if ($param->actionDesc != null){
            $actionDesc = addslashes($param->actionDesc);
        }else{
            $actionDesc = $param["actionDesc"];
        }

        $ip = addslashes($_SERVER['REMOTE_ADDR']);


        $SQL = "INSERT INTO AUDIT
					(USER_ID,
					IP,
					ACTION_DESC)
				VALUES
                        ('$userId',
					'$ip',
					'$actionDesc')";

        $RET = fnDB_DO_EXEC($DB,$SQL);

        // $paramUser->id = $RET[1]; //esse array retorna na posição 0 o número de linhas afetadas pelo update e na posição 1 o id do regitro inserido

        return $RET;
    }

}
?>