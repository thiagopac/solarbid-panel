<?php
    header('Content-type:application/json;charset=utf-8'); //header('Content-type:text/html;charset=utf-8');

	require_once('../../models/User.php');

	if(isset($_POST['type']) && !empty($_POST['type'])) {
        $type = $_POST['type'];
	}

	//se estiver verificando a nova conta
    if(isset($_POST['account-verify']) && !empty($_POST['account-verify'])) {

        $response = new Response();

        $accountVerify = $_POST['account-verify'];
        $response = User::verifyUserAccount($accountVerify);
    }

	if ($type == "sign-in"){

        $response = new Response();

        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);

        $user = User::getUserWithCredentials($strUsername, $strPassword);

        if ($user == null) {

            $response = new Response(["status" => "2", "type" => "error", "title" => "Erro", "description" => "Nome de usuário ou senha incorretos"]);

        }else{

            if ($user->activated == false){
                $response = new Response(["status" => "2", "type" => "error", "title" => "Erro", "description" => "Verifique seu e-mail para efetuar a ativação da sua conta"]);
            }else{
                session_start();
                $_SESSION['USER'] = $user; //$_SESSION['USER']->username;

//                Audit::insertAudit(["user_id" => $affectedUser->id, "action_desc" => "Efetuou login", "ip" => addslashes($_SERVER['REMOTE_ADDR'])]);
                $sent = Mail::sendMailUserLoggedIn($user->email, $user->username, $user);
                $response = new Response(["status" => "1", "type" => "success", "title" => "Sucesso", "description" => "Login efetuado com sucesso"]);
            }
        }

        echo json_encode($response, JSON_NUMERIC_CHECK);

	}else if($type == "sign-up"){

        $response = new Response();

        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);
        $strEmail = strtolower(addslashes($_POST['email']));
        $role = ($_POST['role']);

        //TODO: alterar para combos com países e idiomas possíveis
        $languageId = 1;
        $countryId = 1;

        $roleId = null;

        switch ($role) {
            case "customer":
                $roleId = 2;
                break;
            case "provider":
                $roleId = 3;
                break;
            default:
                $roleId = 2; //usuário padrão é o cliente. Admin não é cadastrável
                break;
        }

        //Programacao
        $DB = fnDBConn();
        $response = User::insertUser($strUsername, $strPassword, $strEmail, $countryId, $languageId, $roleId);

	}else if($type == "forgot-password"){

        $response = new Response();

        ### INPUTS
        $strEmail = strtolower(addslashes($_POST['email']));

        $response = User::sendRecoveryMail($strEmail);
	}s
?>
