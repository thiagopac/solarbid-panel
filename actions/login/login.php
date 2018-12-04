<?php
<<<<<<< HEAD
    header('Content-type:application/json;charset=utf-8'); //header('Content-type:text/html;charset=utf-8');
=======
    header('Content-type:application/json;charset=utf-8');
>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d

	require_once('../../models/User.php');
<<<<<<< HEAD
    require_once('../../internationalization/Translate.php');
=======
    require_once '../../models/Connection.php';
    require_once '../../models/Response.php';
    require_once '../../internationalization/Translate.php';
>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d

    User::setConnection(Connection::getInstance('../../lib/configdb.ini'));



    if(isset($_POST['type']) && !empty($_POST['type'])) {
        $type = $_POST['type'];
	}

    $t = new Translate();

	//se estiver verificando a nova conta
    if(isset($_POST['account-activate']) && !empty($_POST['account-activate'])) {

        $accountActivate = $_POST['account-activate'];
        $userActivated = User::activateUserAccount($accountActivate);

//        var_dump($userActivated);
//        exit;

        if ($userActivated->activated == true){

//            Audit::insertAudit(["user_id" => $affectedUser->id, "action_desc" => "Ativou a conta"]);

<<<<<<< HEAD
            Mail::sendMailUserAccountActivated($userActivated->email, $userActivated->username);

            $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Sua conta foi verificada com sucesso!"}]);
        }else{
            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Ocorreu um erro ao tentar verificar sua conta. Tente novamente mais tarde."}]);
        }

        echo json_encode($response, JSON_NUMERIC_CHECK);
=======
//        $response = new Response();
//
//        $accountVerify = $_POST['account-verify'];
//        $response = User::verifyUserAccount($accountVerify);

>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d

    }

	if ($type == "sign-in"){

<<<<<<< HEAD
=======
//        $response = new Response();

>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d
        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);

        $user = User::getUserWithCredentials($strUsername, $strPassword);
<<<<<<< HEAD
=======

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

>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d

        if ($user == null) {

<<<<<<< HEAD
            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Nome de usuário ou senha incorretos"}]);

        }else{

            if ($user->activated == false){
                $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Verifique seu e-mail para efetuar a ativação da sua conta. Não recebeu o e-mail para ativação? Então, <a class='m--font-info' href='http://localhost/solarbid/panel/login?account-activate=".sha1(md5($user->id))."'>Clique aqui</a>"}]);
            }else{
                session_start();
                $_SESSION['USER'] = $user; //$_SESSION['USER']->username;

//                Audit::insertAudit(["user_id" => $affectedUser->id, "action_desc" => "Efetuou login", "ip" => addslashes($_SERVER['REMOTE_ADDR'])]);
                $sent = Mail::sendMailUserLoggedIn($user->email, $user->username, $user);
                $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Login efetuado com sucesso"}]);
            }
        }

        echo json_encode($response, JSON_NUMERIC_CHECK);

	}else if($type == "sign-up"){
=======
//        $response = new Response();
>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d

        ### INPUTS
        $registry = ($_POST['registry']);
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);
        $strEmail = strtolower(addslashes($_POST['email']));
        $role = ($_POST['role']);

<<<<<<< HEAD
        //TODO: alterar para combos com países e idiomas possíveis
        $languageId = 1;
        $countryId = 1;

        $hpassword = password_hash($strPassword, PASSWORD_DEFAULT);

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

        $content = array("username" => $strUsername, "password" => $hpassword, "email" => $strEmail, "country_id" => $countryId, "language_id" => $languageId, "role_id" => $roleId, "registry_type_id" => $registry);


        //checar se username já não está em uso
        $existingUsername = User::checkExistingUsername($content[username]);

        if ($existingUsername == false){
            $registered = User::insertUser($content);

            if ($registered != null){

//                Audit::insertAudit(["user_id" => $RESULT[1], "action_desc" => "Se cadastrou"]);

                Mail::sendMailActivateAccountCreation($registered->email, $registered->username, sha1(md5($registered->id)));

                $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Cadastro efetuado com sucesso. Verifique seu e-mail para efetuar a ativação da sua conta."}]);
            }else{
                $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Ocorreu um erro ao criar a sua conta. Tente novamente mais tarde."}]);
            }

        }else{
            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Este nome de usuário já está sendo utilizado. Por favor, escolha outro."}]);
        }

        echo json_encode($response, JSON_NUMERIC_CHECK);


	}else if($type == "forgot-password"){

=======
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
>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d

        ### INPUTS
        $strEmail = strtolower(addslashes($_POST['email']));

<<<<<<< HEAD
        $user = User::find("email = '$strEmail'");

        if ($user->email == null){

            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Aviso"}, "description" => $t->{"Não existe nenhum usuário cadastrado com este e-mail. Por favor, verifique o campo de e-mail e tente novamente."}]);
        }else{

            $send = User::sendRecoveryMail($strEmail);

            if ($send) {
                //enviado com sucesso

                $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"E-mail de redefinição de senha enviado com sucesso. Por favor, verifique sua caixa de e-mail e siga as instruções para redefinir sua senha."}]);
            } else {
                //erro ao enviar

                $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Aviso"}, "description" => $t->{"Ocorreu um erro ao tentar enviar o e-mail de redefinição. Tente novamente mais tarde."}]);
            }

        }

        echo json_encode($response, JSON_NUMERIC_CHECK);
	}
=======
//        $response = User::sendRecoveryMail($strEmail);
	}

    echo json_encode($response, JSON_NUMERIC_CHECK);
>>>>>>> f7e64553de84fbe84d24f6128abff62036bf344d
?>
