<?php
    header('Content-type:application/json;charset=utf-8');

	### INCLUDE
	require_once('../../models/User.php');
    require_once '../../models/Connection.php';
    require_once '../../models/Response.php';
    require_once '../../internationalization/Translate.php';

    User::setConnection(Connection::getInstance('../../lib/configdb.ini'));



    if(isset($_POST['type']) && !empty($_POST['type'])) {
        $type = $_POST['type'];
	}

	//se estiver verificando a nova conta
    if(isset($_POST['account-verify']) && !empty($_POST['account-verify'])) {

//        $response = new Response();
//
//        $accountVerify = $_POST['account-verify'];
//        $response = User::verifyUserAccount($accountVerify);


    }

	if ($type == "sign-in"){

//        $response = new Response();

        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);

        $user = User::getUserWithCredentials($strUsername, $strPassword);

        $response = new Response();
        $t = new Translate();

        if ($user == null) {

            $response->status = 2;
            $response->type = "error";
            $response->title = "Erro";
            $response->description = "Nome de usuário ou senha incorretos";

        }else{

            if ($user->activated == false){

                $response->status = 2;
                $response->type = "error";
                $response->title = "Erro";
                $response->description = "Verifique seu e-mail para efetuar a ativação da sua conta.";

            }else{

                //Inicia a sessao
                session_start();
                $_SESSION['USER'] = $user;

//                Audit::insertAudit(['userId' => $user->id, 'actionDesc' => 'Efetuou login']);
//
//                Mail::sendMailUserLoggedIn($user->email, $user->username, $user);

                $response->status = 1;
                $response->type = "success";
                $response->title = "Sucesso";
                $response->description = "Login efetuado com sucesso";

                $response->user = $user;
            }

        }


	}else if($type == "sign-up"){

//        $response = new Response();

        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);
        $strEmail = strtolower(addslashes($_POST['email']));
        $role = ($_POST['role']);

//        //TODO: alterar para combos com países e idiomas possíveis
//        $languageId = 1;
//        $countryId = 1;
//
//        $roleId = null;
//
//        switch ($role) {
//            case "customer":
//                $roleId = 1;
//                break;
//            case "provider":
//                $roleId = 2;
//                break;
//            default:
//                $roleId = 1; //usuário padrão é o cliente. Admin não é cadastrável
//                break;
//        }
//
//        //Programacao
//        $DB = fnDBConn();
//        $response = User::insertUser($strUsername, $strPassword, $strEmail, $countryId, $languageId, $roleId);

	}else if($type == "forgot-password"){

//        $response = new Response();

        ### INPUTS
        $strEmail = strtolower(addslashes($_POST['email']));

//        $response = User::sendRecoveryMail($strEmail);
	}

    echo json_encode($response, JSON_NUMERIC_CHECK);
?>
