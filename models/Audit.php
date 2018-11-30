<?php

class Audit {

	public $id;
    public $user_id;
	public $ip;
	public $action_desc;
	public $created_at;

	//construtor da classe
	public function __construct(array $array = []){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['id'];
            $this->user_id = $array['user_id'];
			$this->ip = $array['ip'];
			$this->action_desc = $array['action_desc'];
			$this->created_at = $array['created_at'];
		}
  }

	public function __destruct(){

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