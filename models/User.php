<?php

require_once('../../lib/config.php');
require_once('Audit.php');
require_once('Mail.php');
require_once('Response.php');
require_once('../../internationalization/Translate.php');

class User {

	public $id;
	public $username;
	public $password;
    public $email;
	public $created_at;
	public $updated_at;
    public $role_id;
	public $language_id;
	public $country_id;
    public $activated;
    public $mail_notification;

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
			$this->language_id = $array['language_id'];
			$this->country_id = $array['country_id'];
            $this->activated = $array['activated'];
            $this->mail_notification = json_decode($array['mail_notification']);
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

    public function save() {

	    //VER SE O ID CHEGOU NO OBJETO, SE CHEGOU, É UM UPDATE, SE NÃO CHEGOU, É INSERT
        //VER COMO ENVIAR OS NOMES DOS CAMPOS E OS VALORES PARA SEREM ATUALIZADOS OU INSERIDOS

        if (isset($this->content[$this->idField])) {
            $sql = "UPDATE {$this->table} SET " . implode(', ', $sets) . " WHERE {$this->idField} = {$this->content[$this->idField]};";
        } else {

            $sql = "INSERT INTO {$this->table} (" . implode(', ', array_keys($newContent)) . ') VALUES (' . implode(',', array_values($newContent)) . ');';
        }
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

        $user = self::find("SHA1(MD5(u.id)) = '".$hashedId."'");

        return $user;
    }

	public static function updateUserData($username, $email, $countryId, $languageId, $roleId, $id){
		$DB = fnDBConn();

		$SQL = "UPDATE
					USER AS U
				SET
					U.USERNAME = '$username',
					U.EMAIL = '$email',
					U.COUNTRY_ID = '$countryId',
					U.LANGUAGE_ID = '$languageId',
                    U.ROLE_ID = '$roleId'
				WHERE
					U.ID = '$id'";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		return $RET;
	}

	public function deleteUser($id){
		$DB = fnDBConn();

		$SQL = "UPDATE
					USER AS U
				SET
					U.DELETED = 1
				WHERE
					U.ID = '$id'";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		return $RET;
	}

	public function updateSelfProfile($password, $email, $countryId, $languageId, $id){
		$DB = fnDBConn();

        $hpassword = password_hash($password, PASSWORD_DEFAULT);

		$SQL = "UPDATE
					USER AS U
				SET
					U.PASSWORD = '$hpassword',
					U.EMAIL = '$email',
					U.LANGUAGE_ID = '$languageId',
					U.COUNTRY_ID = '$countryId'
				WHERE U.ID = '$id'";

		$RET = fnDB_DO_EXEC($DB,$SQL);

		return $RET;
	}

	public static function insertUser($username, $password, $email, $countryId, $languageId, $roleId){
		$DB = fnDBConn();

//        $baseSalt = $param->username.$param->email.$param->password;
//        $salt = strtoupper(substr(strtolower(preg_replace('/[0-9_\/]+/', '', base64_encode(sha1($baseSalt)))) , 0, 6));

        $hpassword = password_hash($password, PASSWORD_DEFAULT);

        //checar se username já não está em uso
		$existingUsername = User::checkExistingUsername($username);

      	$response = new Response();
        $t = new Translate();

		if ($existingUsername == true){

            $response->status = 2;
            $response->type = "warning";
            $response->title = $t->{"Aviso"};
            $response->description = $t->{"Este nome de usuário já está sendo utilizado. Por favor, escolha outro."};

            return $response;

		}else{
            $SQL = "INSERT INTO USER
						(USERNAME,
						PASSWORD,
						EMAIL,
						ROLE_ID,
						LANGUAGE_ID,
						COUNTRY_ID)
					VALUES
						('$username',
						'$hpassword',
						'$email',
						'$roleId',
						'$languageId',
						'$countryId')";

            $RESULT = fnDB_DO_EXEC($DB,$SQL);
		}


        if ($RESULT[1] != null){ //$RESULT[1] tem o ID do registro inserido

            Audit::insertAudit(["userId" => $RESULT[1], "actionDesc" => "Se cadastrou"]);

            Mail::sendMailVerifyAccountCreation($email, $username, sha1(md5($RESULT[1])));

        	$response->status = 1;
            $response->type = "success";
            $response->title = $t->{"Sucesso"};
            $response->description = $t->{"Cadastro efetuado com sucesso. Verifique seu e-mail para efetuar a ativação da sua conta."};

		}else{

            $response->status = 2;
            $response->type = "danger";
            $response->title = $t->{"Erro"};
            $response->description = $t->{"Ocorreu um erro ao criar a sua conta. Tente novamente mais tarde."};
		}

        return $response;
	}

	public static function sendRecoveryMail($email){

        $user = self::find("email = {$email}");

		$send = Mail::sendMailPasswordRedefinition($user->email, $user->username, sha1(md5($user->id)));

        if ($user->email == null){

            $response->status = 2;
            $response->type = "error";
            $response->title = $t->{"Aviso"};
            $response->description = $t->{"Não existe nenhum usuário cadastrado com este e-mail. Por favor, verifique o campo de e-mail e tente novamente."};

            return $response;
        }


        if ($send) {
            //enviado com sucesso

            $response->status = 1;
            $response->type = "success";
            $response->title = $t->{"Sucesso"};
            $response->description = $t->{"E-mail de redefinição de senha enviado com sucesso. Por favor, verifique sua caixa de e-mail e siga as instruções para redefinir sua senha."};
		} else {
            //erro ao enviar

            $response->status = 2;
            $response->type = "error";
            $response->title = $t->{"Aviso"};
            $response->description = $t->{"Ocorreu um erro ao tentar enviar o e-mail de redefinição. Tente novamente mais tarde."};
        }

        return $send;

	}

    public static function resetUserPassword($password, $hashedId){
        $DB = fnDBConn();

        $hpassword = password_hash($password, PASSWORD_DEFAULT);

        $SQL = "UPDATE
					USER AS U
				SET
					U.PASSWORD = '$hpassword'
				WHERE SHA1(MD5(U.ID)) = '$hashedId'";

        $RESULT = fnDB_DO_EXEC($DB,$SQL);

        $t = new Translate();
        $response = new Response();

        $affectedUser = User::getUserWithHashedId($hashedId);

        if ($RESULT != null){

            Audit::insertAudit(["userId" => $affectedUser->id, "actionDesc" => "Alterou a senha"]);

            Mail::sendMailPasswordHasChanged($affectedUser->email, $affectedUser->username, $affectedUser);

            $response->status = 1;
            $response->type = "success";
            $response->title = $t->{"Sucesso"};
            $response->description = $t->{"Senha alterada com sucesso! Você está sendo redirecionado para a página de login."};

        }else{

            $response->status = 2;
            $response->type = "danger";
            $response->title = $t->{"Erro"};
            $response->description = $t->{"Ocorreu um erro ao tentar alterar sua senha. Tente novamente mais tarde."};
        }

        return $response;
    }

    public static function verifyUserAccount($hashedId){
        $DB = fnDBConn();

        $SQL = "UPDATE
					USER AS U
				SET
					U.VERIFIED = 1
				WHERE SHA1(MD5(U.ID)) = '$hashedId'";

        $RESULT = fnDB_DO_EXEC($DB,$SQL);

        $t = new Translate();
        $response = new Response();

        $affectedUser = User::getUserWithHashedId($hashedId);

        if ($RESULT != null){

            Audit::insertAudit(["userId" => $affectedUser->id, "actionDesc" => "Ativou a conta"]);

            Mail::sendMailUserAccountVerified($affectedUser->email, $affectedUser->username);

            $response->status = 1;
            $response->type = "success";
            $response->title = $t->{"Sucesso"};
            $response->description = $t->{"Sua conta foi verificada com sucesso!"};

        }else{

            $response->status = 2;
            $response->type = "danger";
            $response->title = $t->{"Erro"};
            $response->description = $t->{"Ocorreu um erro ao tentar verificar sua conta. Tente novamente mais tarde."};
        }

        return $response;
    }

}
?>