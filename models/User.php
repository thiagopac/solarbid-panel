<?php

require_once('Role.php');
require_once('Language.php');
require_once('Country.php');

class User {

	public $id;
	public $username;
	public $password;
    public $email;
	public $din;
	public $lastLogin;
    public $roleId;
	public $languageId;
	public $countryId;

	//propriedades entidades
    public $role;
	public $country;
	public $language;

	//construtor da classe
	public function __construct($array){

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['ID'];
			$this->username = $array['USERNAME'];
            $this->password = $array['PASSWORD'];
            $this->email = $array['EMAIL'];
			$this->din = $array['DIN'];
			$this->lastLogin = $array['LAST_LOGIN'];
            $this->roleId = $array['ROLE_ID'];
			$this->languageId = $array['LANGUAGE_ID'];
			$this->countryId = $array['COUNTRY_ID'];
		}
  }

	public function __destruct(){

	}

	public function getAllUsers(){

		$DB = fnDBConn();

		$SQL = "SELECT
					U.ID,
					U.USERNAME,
					U.EMAIL,
					U.DIN,
					U.LAST_LOGIN,
					U.COUNTRY_ID,
					U.LANGUAGE_ID,
					U.ROLE_ID
				FROM
					USER AS U
				WHERE
					1";

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arrUsers = [];

		foreach($RESULT as $KEY => $ROW){
	    $user = new User($ROW);
			array_push($arrUsers, $user);
	  }

		return $arrUsers;
	}

    function getUserWithCredentials($param) {

        $DB = fnDBConn();

        $SQL = "SELECT
					U.ID,
					U.USERNAME,
					U.PASSWORD,
					U.EMAIL,
					U.DIN,
					U.LAST_LOGIN,
					U.ROLE_ID,
					U.LANGUAGE_ID,
					U.COUNTRY_ID
				FROM
					USER AS U
				WHERE
					U.USERNAME = '$param->username'";

        $RESULT = fnDB_DO_SELECT($DB,$SQL);

        $user = new User($RESULT);

        return $user;
    }

	public function getUserWithId($param){

		$DB = fnDBConn();

		$SQL = "SELECT
					U.ID,
					U.USERNAME,
					U.EMAIL,
					U.DIN,
					U.LAST_LOGIN,
					U.ROLE_ID,
					U.LANGUAGE_ID,
					U.COUNTRY_ID
				FROM
					USER AS U
				WHERE
					U.ID = '$param->id'";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$user = new User($RESULT);

		return $user;
	}

	public function updateUserData($param){
		$DB = fnDBConn();

		$SQL = "UPDATE
					USER AS U
				SET
					U.USERNAME = '$param->username',
					U.EMAIL = '$param->email',
					U.COUNTRY_ID = '$param->countryId',
					U.LANGUAGE_ID = '$param->languageId',
                    U.ROLE_ID = '$param->roleId'
				WHERE
					U.ID = '$param->id'";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		//Adiciona registro na tabela de auditoria
	  	fnDB_LOG_AUDIT_ADD($DB,"O usuário atualizou os Dados de Usuário.");

		return $RET;
	}

	public function deleteUser($paramUser){
		$DB = fnDBConn();

		$SQL = "UPDATE
					USER AS U
				SET
					U.DELETED = 1
				WHERE
					U.ID = '$paramUser->id'";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		//Adiciona registro na tabela de auditoria
		fnDB_LOG_AUDIT_ADD($DB,"Apagou um usuário.");

		return $RET;
	}

	public function updateSelfProfile($param){
		$DB = fnDBConn();

        $password = password_hash($param->password, PASSWORD_DEFAULT);

		$SQL = "UPDATE
					USER AS U
				SET
					U.PASSWORD = '$password',
					U.EMAIL = '$param->email',
					U.LANGUAGE_ID = '$param->languageId',
					U.COUNTRY_ID = '$param->countryId'
				WHERE U.ID = '$param->id'";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		//Adiciona registro na tabela de auditoria
		fnDB_LOG_AUDIT_ADD($DB,"O usuário atualizou seu perfil.");

		return $RET;
	}

	public function insertUser($param){
		$DB = fnDBConn();

//        $baseSalt = $param->username.$param->email.$param->password;
//        $salt = strtoupper(substr(strtolower(preg_replace('/[0-9_\/]+/', '', base64_encode(sha1($baseSalt)))) , 0, 6));

        $password = password_hash($param->password, PASSWORD_DEFAULT);

		$SQL = "INSERT INTO USER
					(USERNAME,
					PASSWORD,
					EMAIL,
					ROLE_ID,
					LANGUAGE_ID,
					COUNTRY_ID)
				VALUES
					('$param->username',
					'$password',
					'$param->email',
					'$param->roleId',
					'$param->languageId',
					'$param->countryId')";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		return $RET;
	}

}

?>
