<?php

class FisicalPerson {

	public $id;
	public $fullname;
	public $nickname;
	public $social_security;
	public $national_card;
	public $user_id;

	protected static $table = "fisical_person";

	public function __construct($array){

		if (!empty($array)) {
			$this->id = $array['id'];
			$this->fullname = $array['fullname'];
			$this->nickname = $array['nickname'];
			$this->social_security = $array['social_security'];
			$this->national_card = $array['national_card'];
			$this->user_id = $array['user_id'];
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

}
?>
