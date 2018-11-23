<?php

require_once('../../lib/config.php');
require_once('Role.php');
require_once('Language.php');
require_once('Country.php');
require_once('Response.php');
require_once('Audit.php');
require_once('Mail.php');
require_once('../../internationalization/Translate.php');

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
    public $verified;
    public $mailNotification;

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
            $this->verified = $array['VERIFIED'];
            $this->mailNotification = json_decode($array['MAIL_NOTIFICATION']);
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
					U.ROLE_ID,
					U.VERIFIED
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

    function checkExistingUsername($param) {

        $DB = fnDBConn();

        $SQL = "SELECT
					U.ID
				FROM
					USER AS U
				WHERE
					U.USERNAME = '$param->username'";

        $RESULT = fnDB_DO_SELECT($DB,$SQL);

        $existing = $RESULT["ID"] == null ? false : true;
        return $existing;
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
					U.COUNTRY_ID,
					U.VERIFIED,
					U.MAIL_NOTIFICATION
				FROM
					USER AS U
				WHERE
					U.USERNAME = '$param->username'";

        $RESULT = fnDB_DO_SELECT($DB,$SQL);

        $user = new User($RESULT);

        $access = password_verify($param->password, $user->password); //password é um hash possível do que foi recebido

        unset($user->password);

        $response = new Response();
        $t = new Translate();

        if ($access == false) {

            $response->status = 2;
            $response->type = "error";
            $response->title = $t->{"Erro"};
            $response->description = $t->{"Nome de usuário ou senha incorretos"};

        }else{

            if ($user->verified == false){

                $response->status = 2;
                $response->type = "error";
                $response->title = $t->{"Erro"};
                $response->description = $t->{"Verifique seu e-mail para efetuar a ativação da sua conta."};

            }else{

                //Inicia a sessao
                session_start();
                $_SESSION['USER'] = $user;

                //Adiciona registro na tabela de auditoria
                Audit::insertAudit(['userId' => $user->id, 'actionDesc' => 'Efetuou login']);

                Mail::sendMailUserLoggedIn($user->email, $user->username, $user);

                $response->status = 1;
                $response->type = "success";
                $response->title = $t->{"Sucesso"};
                $response->description = $t->{"Login efetuado com sucesso"};

                $response->user = $user;
            }

        }

        return $response;
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
					U.COUNTRY_ID,
					U.VERIFIED,
					U.MAIL_NOTIFICATION
				FROM
					USER AS U
				WHERE
					U.ID = '$param->id'";

		$RESULT = fnDB_DO_SELECT($DB,$SQL);

		$user = new User($RESULT);

		return $user;
	}

    public function getUserWithHashedId($param){

        $DB = fnDBConn();

        $SQL = "SELECT
					U.ID,
					U.USERNAME,
					U.EMAIL,
					U.MAIL_NOTIFICATION
				FROM
					USER AS U
				WHERE
					SHA1(MD5(U.ID)) = '$param->hashedId'";

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

		return $RET;
	}

	public function insertUser($param){
		$DB = fnDBConn();

//        $baseSalt = $param->username.$param->email.$param->password;
//        $salt = strtoupper(substr(strtolower(preg_replace('/[0-9_\/]+/', '', base64_encode(sha1($baseSalt)))) , 0, 6));

        $password = password_hash($param->password, PASSWORD_DEFAULT);

        //checar se username já não está em uso
		$existingUsername = $this->checkExistingUsername($param);

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
						('$param->username',
						'$password',
						'$param->email',
						'$param->roleId',
						'$param->languageId',
						'$param->countryId')";

            $RESULT = fnDB_DO_EXEC($DB,$SQL);
		}


        if ($RESULT[1] != null){ //$RESULT[1] tem o ID do registro inserido

            //Adiciona registro na tabela de auditoria
            Audit::insertAudit(["userId" => $RESULT[1], "actionDesc" => "Se cadastrou"]);

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

	public function sendRecoveryMail($param){

        $DB = fnDBConn();

        $t = new Translate();
        $response = new Response();

        $SQL = "SELECT
					U.ID,
					U.USERNAME,
					U.EMAIL,
					U.LANGUAGE_ID
				FROM
					USER AS U
				WHERE
					U.EMAIL = '$param->email'";

        $RESULT = fnDB_DO_SELECT($DB,$SQL);

        $user = new User($RESULT);

        if ($user->email == null){

            $response->status = 2;
            $response->type = "error";
            $response->title = $t->{"Aviso"};
            $response->description = $t->{"Não existe nenhum usuário cadastrado com este e-mail. Por favor, verifique o campo de e-mail e tente novamente."};

            return $response;
        }

		$send = Mail::sendMailPasswordRedefinition($user->email, $user->username, sha1(md5($user->id)));

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

        return $response;

	}

    public function resetUserPassword($param){
        $DB = fnDBConn();

        $password = password_hash($param->password, PASSWORD_DEFAULT);

        $SQL = "UPDATE
					USER AS U
				SET
					U.PASSWORD = '$password'
				WHERE SHA1(MD5(U.ID)) = '$param->hashedId'";

        $RESULT = fnDB_DO_EXEC($DB,$SQL);

        $t = new Translate();
        $response = new Response();

        $affectedUser = $this->getUserWithHashedId($param);

        if ($RESULT != null){

            //Adiciona registro na tabela de auditoria
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
            $response->description = $t->{"Ocorreu um erro ao tentar alterar sua senha  . Tente novamente mais tarde."};
        }

        return $response;
    }

}

/**
<p>Voc&ecirc; est&aacute; recebendo este e-mail devido a sua solicita&ccedil;&atilde;o de redefini&ccedil;&atilde;o de senha.<br /><br />Para gerar uma nova senha, por favor acesse a seguinte URL:</p>
<p><a href="http://localhost/solarbid/panel/reset-password?validate=bd71130278a8b9a4751ae6a262b74a8a844f1e0e">http://localhost/solarbid/panel/reset-password?validate=bd71130278a8b9a4751ae6a262b74a8a844f1e0e</a></p>
<p>Caso voc&ecirc; n&atilde;o tenha requisitado a redefini&ccedil;&atilde;o de senha, apenas ignore este e-mail.</p>
 **/
?>