<?php
require_once('Country.php');
require_once('Language.php');

class User {

	public $id;
	public $login;
	public $password;
	public $grants;
	public $name;
	public $avatar;
	public $status;
	public $birthday;
	public $dateCreated;
	public $dateLastLogin;
	public $languageId;
	public $countryID;
	public $deleted;

	//propriedades entidades
	public $country;
	public $language;

	static $showDeleted;
	static $whereDeleted;

	//construtor da classe
	public function __construct($array){

		self::$whereDeleted = self::$showDeleted == true ? "" : " AND U.DELETED = 0";

		//se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
		if (!empty($array)) {
			$this->id = $array['USER_ID'];
			$this->login = $array['USER_LOGIN'];
			$this->grants = $array['USER_GRANTS'];
			$this->name = $array['USER_NAME'];
			$this->avatar = $array['USER_AVATAR'];
			$this->status = $array['USER_STATUS'];
			$this->birthday = $array['USER_BIRTHDAY'];
			$this->dateCreated = $array['USER_DATE_CREATED'];
			$this->dateLastLogin = $array['USER_LAST_LOGIN'];
			$this->deleted = $array['USER_DELETED'];
			$this->languageID = $array['LANGUAGE_ID'];
			$this->countryID = $array['COUNTRY_ID'];
		}
  }

	public function __destruct(){

	}

	public function getAllUsers(){

		$DB = fnDBConn();

		$SQL = "SELECT
							U.ID AS USER_ID,
							U.LOGIN AS USER_LOGIN,
							U.NAME AS USER_NAME,
							U.AVATAR AS USER_AVATAR,
							U.GRANTS AS USER_GRANTS,
							U.STATUS AS USER_STATUS,
							U.BIRTHDAY AS USER_BIRTHDAY,
							U.DIN AS USER_DATE_CREATED,
							U.DIN_LAST_LOGIN AS USER_LAST_LOGIN,
							U.ID_COUNTRY AS COUNTRY_ID,
							U.ID_LANGUAGE AS LANGUAGE_ID,
							U.DELETED AS USER_DELETED
						FROM
							USER AS U
						WHERE
							1";

		$SQL = $SQL.self::$whereDeleted;

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arrUsers = [];

		foreach($RESULT as $KEY => $ROW){
	    $user = new User($ROW);
			array_push($arrUsers, $user);
	  }

		return $arrUsers;
	}

	public function getAllActiveUsers(){

		$DB = fnDBConn();

		$SQL = "SELECT
							U.ID AS USER_ID,
							U.LOGIN AS USER_LOGIN,
							U.NAME AS USER_NAME,
							U.AVATAR AS USER_AVATAR,
							U.GRANTS AS USER_GRANTS,
							U.STATUS AS USER_STATUS,
							U.BIRTHDAY AS USER_BIRTHDAY,
							U.DIN AS USER_DATE_CREATED,
							U.DIN_LAST_LOGIN AS USER_LAST_LOGIN,
							U.ID_COUNTRY AS COUNTRY_ID,
							U.ID_LANGUAGE AS LANGUAGE_ID,
							U.DELETED AS USER_DELETED
						FROM
							USER AS U
						WHERE
							U.STATUS = 1
							AND U.DELETED = 0";

		$SQL = $SQL.self::$whereDeleted;

		$RESULT = fnDB_DO_SELECT_WHILE($DB,$SQL);

		$arrUsers = [];

		foreach($RESULT as $KEY => $ROW){
			$user = new User($ROW);
			array_push($arrUsers, $user);
		}

		return $arrUsers;
	}

	public function getUserWithId($paramUser){

		$DB = fnDBConn();

		$SQL = "SELECT
							U.ID AS USER_ID,
							U.LOGIN AS USER_LOGIN,
							U.FIRSTNAME AS USER_FIRSTNAME,
							U.LASTNAME AS USER_LASTNAME,
							U.AVATAR AS USER_AVATAR,
							U.GRANTS AS USER_GRANTS,
							U.ELO_FIDE AS USER_ELO_FIDE,
							U.STATUS AS USER_STATUS,
							U.BIRTHDAY AS USER_BIRTHDAY,
							U.DIN AS USER_DATE_CREATED,
							U.DIN_LAST_LOGIN AS USER_LAST_LOGIN,
							U.ID_TYPE_USER AS USER_TYPE_USER,
							U.ID_COUNTRY AS COUNTRY_ID,
							U.ID_LANGUAGE AS LANGUAGE_ID,
							U.ID_INTERFACE_LANGUAGE AS INTERFACE_LANGUAGE_ID,
							U.ID_THEME AS THEME_ID,
							U.DELETED AS USER_DELETED
						FROM
							USER AS U
						WHERE
							U.ID = $paramUser";

		$SQL = $SQL.self::$whereDeleted;

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$user = new User($RESULT);

		return $user;
	}

	public function updateUserData($paramUser){
		$DB = fnDBConn();

		$SQL = "UPDATE
							USER AS U
						SET
							U.LOGIN = '$paramUser->login',
							U.NAME = '$paramUser->name',
							U.GRANTS = '$paramUser->grants',
							U.STATUS = '$paramUser->status',
							U.BIRTHDAY = '$paramUser->birthday',
							U.ID_COUNTRY = '$paramUser->countryID',
							U.ID_LANGUAGE = '$paramUser->languageID',
							U.DELETED = '$paramUser->deleted'
						WHERE
							U.ID = '$paramUser->id'";

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

	public function updateSelfProfile($paramUser){
		$DB = fnDBConn();

		$SQL = "UPDATE
							USER AS U
						SET
							U.NAME = '$paramUser->name',
							U.BIRTHDAY = '$paramUser->birthday',
							U.ID_COUNTRY = '$paramUser->countryID',
							U.ID_LANGUAGE = '$paramUser->languageID'
						WHERE U.ID = '$paramUser->id'";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		//Adiciona registro na tabela de auditoria
		fnDB_LOG_AUDIT_ADD($DB,"O usuário atualizou seu perfil.");

		return $RET;
	}

	public function insertUser($paramUser){
		$DB = fnDBConn();

		$SQL = "INSERT INTO USER
							(NAME,
							LOGIN,
							GRANTS,
							BIRTHDAY,
							ID_COUNTRY,
							ID_LANGUAGE,
							STATUS,
							DELETED)
						VALUES
							('$paramUser->name',
							'$paramUser->login',
							'$paramUser->grants',
							'$paramUser->birthday',
							'$paramUser->countryID',
							'$paramUser->languageID',
							'$paramUser->status',
							'$paramUser->deleted')";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		// $paramUser->id = $RET[1]; //esse array retorna na posição 0 o número de linhas afetadas pelo update e na posição 1 o id do regitro inserido

		//Adiciona registro na tabela de auditoria
		fnDB_LOG_AUDIT_ADD($DB,"Novo usuário criado.");

		return $RET;
	}

}

?>
