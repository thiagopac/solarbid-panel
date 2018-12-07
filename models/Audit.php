<?php

class Audit {

	public $id;
    public $user_id;
	public $ip;
	public $action_desc;
	public $created_at;

	protected static $table = "audit";

	//construtor da classe
	public function __construct($array = []){

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
        $table = $class::$table;
        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
        $sql .= ($filter !== '') ? " WHERE {$filter}" : "";
        $sql .= ($limit > 0) ? " LIMIT {$limit}" : "";
        $sql .= ($offset > 0) ? " OFFSET {$offset}" : "";
        $sql .= ';';

        $result = fnDB_DO_SELECT_WHILE($db, $sql);

        $arr = [];

        foreach($result as $key => $row){
            $obj = new $class($row);
            array_push($arr, $obj);
        }

        return $arr;
    }

    public static function find($parameter) {

        $db = fnDBConn();

        $class = get_called_class();
        $table = $class::$table;
        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
        $sql .= " WHERE {$parameter} ;";

        $result = fnDB_DO_SELECT($db,$sql);

        $obj = new $class($result);

        return $obj;
    }

    public static function save($content) {

        $db = fnDBConn();

        $cols = array();

        $class = get_called_class();
        $table = $class::$table;

        foreach($content as $key=>$val) {
            $cols[] = "$key = '$val'";
        }

        if (isset($content[id])) {
            $sql = "UPDATE $table SET ".implode(', ', $cols)." WHERE id = $content[id];";

        } else {
            $sql = sprintf(
                'INSERT INTO '.$table.' (%s) VALUES ("%s")',
                implode(',',array_keys($content)),
                implode('","',array_values($content))
            );

        }

//        var_dump($sql);
//        exit;

        $execute = fnDB_DO_EXEC($db,$sql);

        return $execute;
    }

    public static function insertAudit(int $user_id, string $action_desc){
        $ip = addslashes($_SERVER['REMOTE_ADDR']);
        $content = array("user_id" => $user_id, "action_desc" => $action_desc, "ip" => $ip);
        self::save($content);
    }
}
?>