<?php

<<<<<<< HEAD
require_once('../../lib/config.php');
require_once('Audit.php');
require_once('Mail.php');
require_once('Response.php');
require_once('../../internationalization/Translate.php');
=======
include_once 'ActiveRecord.php';
>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d

class User extends ActiveRecord {

    public $id;
    public $username;
    public $password;
    public $email;
<<<<<<< HEAD
	public $created_at;
	public $updated_at;
    public $role_id;
	public $country_id;
    public $language_id;
    public $registry_type_id;
    public $mail_notification;
    public $activated;

	//construtor da classe
	public function __construct(array $array = []){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['id'];
			$this->username = $array['username'];
            $this->password = $array['password'];
            $this->email = $array['email'];
			$this->created_at = $array['created_at'];
			$this->updated_at = $array['updated_at'];
            $this->role_id = $array['role_id'];
            $this->country_id = $array['country_id'];
			$this->language_id = $array['language_id'];
            $this->registry_type_id = $array['registry_type_id'];
            $this->mail_notification = json_decode($array['mail_notification']);
            $this->activated = $array['activated'];
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

        $arrUsers = [];

        foreach($result as $key => $row){
            $user = new User($row);
            array_push($arrUsers, $user);
        }

        return $arrUsers;
    }

    public static function find($parameter) {

        $db = fnDBConn();

        $class = get_called_class();
        $table = (new $class())->table;
        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
        $sql .= " WHERE {$parameter} ;";

        $result = fnDB_DO_SELECT($db,$sql);

        $user = new User($result);

        return $user;
    }

    public static function save($content) {

        $db = fnDBConn();

        $cols = array();

        foreach($content as $key=>$val) {
            $cols[] = "$key = '$val'";
        }

        if (isset($content[id])) {
            $sql = "UPDATE user SET ".implode(', ', $cols)." WHERE id = $content[id];";

        } else {
            $sql = sprintf(
                'INSERT INTO user (%s) VALUES ("%s")',
                implode(',',array_keys($content)),
                implode('","',array_values($content))
            );

        }

//        var_dump($sql);
//        exit;

        $execute = fnDB_DO_EXEC($db,$sql);

        return $execute;
    }

    public static function checkExistingUsername($username) {

        $existing = self::all("username = '".$username."'");
        return $existing == null ? false : true;
    }

    public static function getUserWithCredentials($username, $password) {

        $user = self::find("username = '".$username."'");
        $access = password_verify($password, $user->password); //password é um hash possível do que foi recebido
        unset($user->password);
        return $access == true ? $user : null;
    }

	public static function getUserWithId($id){

		$user = self::find("id = {$id}");
		return $user;
	}

    public static function getUserWithHashedId($hashedId){

        $user = self::find("SHA1(MD5(id)) = '".$hashedId."'");

        return $user;
    }

	public static function insertUser($content){

//        $baseSalt = $param->username.$param->email.$param->password;
//        $salt = strtoupper(substr(strtolower(preg_replace('/[0-9_\/]+/', '', base64_encode(sha1($baseSalt)))) , 0, 6));

        $inserted = self::save($content);

        return $inserted[2] == null ? self::find("id = {$inserted[1]}") : null;
	}

	public static function sendRecoveryMail($email){

        $user = self::find("email = '$email'");

        return Mail::sendMailPasswordRedefinition($user->email, $user->username, sha1(md5($user->id)));
	}

    public static function resetUserPassword($password, $hashedId){
        $DB = fnDBConn();

        $hpassword = password_hash($password, PASSWORD_DEFAULT);

        $affectedUser = User::getUserWithHashedId($hashedId);

        $content = array("password" => $hpassword, "id" => $affectedUser->id);

        $save = self::save($content);

        return $save[2] == null ? $affectedUser : null;
    }

    public static function activateUserAccount($hashedId){

        $affectedUser = User::getUserWithHashedId($hashedId);

        $content = array("id" => $affectedUser->id, "activated" => true);

        self::save($content);

        return User::getUserWithHashedId($hashedId);
=======
    public $mail_notification;
    public $created_at;
    public $updated_at;
    public $role_id;
    public $activated;

    protected $logTimestamp = TRUE;

//    public static function listarRecentes(int $dias = 10)
//    {
//        return self::all("created_at >= '" . date('Y-m-d h:m:i', strtotime("-{$dias} days")) . "'");
//    }

    public static function numTotal(){
        return self::count();
    }

    public static function getUserWithCredentials(string $username, string $password){

        $userArr = self::all("username = '$username'");

        $user = json_decode(json_encode((object) $userArr[0]), FALSE);

        $access = password_verify($password, $user->password);

        unset($user->password); //retirar o password do objeto de retorno

        return $access == true ? $user : null;
>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d
    }

}