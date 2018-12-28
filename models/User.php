<?php

require_once('../../lib/config.php');
require_once('../../internationalization/Translate.php');

class User {

	public $id;
	public $username;
	public $password;
    public $email;
	public $created_at;
	public $updated_at;
    public $role_id;
	public $country_id;
    public $language_id;
    public $registry_type_id;
    public $mail_notification;
    public $activated;

    protected static $table = "user";

	public function __construct($array = []){

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

    public static function checkExistingEmail($email) {

        $existing = self::all("email = '".$email."'");
        return $existing == null ? false : true;
    }

    public static function getUserByUsernameAndPassword($username, $password) {

        $user = self::find("username = '".$username."'");
        $access = password_verify($password, $user->password); //password é um hash possível do que foi recebido
        unset($user->password);
        return $access == true ? $user : null;
    }

	public static function getUserById($id){

			$user = self::find("id = {$id}");
			return $user;
	}

  public static function getUserByHashedId($hashedId){

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

        return Mail::sendMailPasswordRedefinition($user);
	}

    public static function resetUserPassword($password, $hashedId){
        $DB = fnDBConn();

        $hpassword = password_hash($password, PASSWORD_DEFAULT);

        $affectedUser = User::getUserByHashedId($hashedId);

        $content = array("password" => $hpassword, "id" => $affectedUser->id);

        $save = self::save($content);

        return $save[2] == null ? $affectedUser : null;
    }

    public static function activateUserAccount($hashedId){

        $affectedUser = User::getUserByHashedId($hashedId);

        $content = array("id" => $affectedUser->id, "activated" => true);

        self::save($content);

        return User::getUserByHashedId($hashedId);
    }

}
?>
