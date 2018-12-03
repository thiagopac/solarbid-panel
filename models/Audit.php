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

    public static function all(string $filter = '', int $limit = 0, int $offset = 0) {

        $db = fnDBConn();

        $class = get_called_class();
        $table = (new $class())->table;
        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
        $sql .= ($filter !== '') ? " WHERE {$filter}" : "";
        $sql .= ($limit > 0) ? " LIMIT {$limit}" : "";
        $sql .= ($offset > 0) ? " OFFSET {$offset}" : "";
        $sql .= ';';

        $result = fnDB_DO_SELECT_WHILE($db, $sql);

        $arr = [];

        foreach($result as $key => $row){
            $obj = new Audit($row);
            array_push($arr, $obj);
        }

        return $arr;
    }

    public static function find($parameter) {

        $db = fnDBConn();

        $class = get_called_class();
        $table = (new $class())->table;
        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
        $sql .= " WHERE {$parameter} ;";

        $result = fnDB_DO_SELECT($db,$sql);

        $obj = new Audit($result);

        return $obj;
    }

    public static function save($content) {

        $db = fnDBConn();

        $cols = array();

        foreach($content as $key=>$val) {
            $cols[] = "$key = '$val'";
        }

        if (isset($content[id])) {
            $sql = "UPDATE audit SET ".implode(', ', $cols)." WHERE id = $content[id];";

        } else {
            $sql = sprintf(
                'INSERT INTO audit (%s) VALUES ("%s")',
                implode(',',array_keys($content)),
                implode('","',array_values($content))
            );

        }

//        var_dump($sql);
//        exit;

        $execute = fnDB_DO_EXEC($db,$sql);

        return $execute;
    }

    public static function insertAudit($param){
        $DB = fnDBConn();

        $user_id = "";
        $ip = "";
        $action_desc = "";

        //tratamento para aceitar objetos ou arrays como parâmetro
        if ($param->userId != null){
            $user_id = $param->user_id;
        }else{
            $user_id = $param["user_id"];
        }

        if ($param->actionDesc != null){
            $action_desc = addslashes($param->action_desc);
        }else{
            $action_desc = $param["action_desc"];
        }

        $ip = addslashes($_SERVER['REMOTE_ADDR']);


        $SQL = "INSERT INTO AUDIT
					(USER_ID,
					IP,
					ACTION_DESC)
				VALUES
                        ('$user_id',
					'$ip',
					'$action_desc')";

        $RET = fnDB_DO_EXEC($DB,$SQL);

        // $paramUser->id = $RET[1]; //esse array retorna na posição 0 o número de linhas afetadas pelo update e na posição 1 o id do regitro inserido

        return $RET;
    }

}
?>