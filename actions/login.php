<?php
    header('Content-type:application/json;charset=utf-8'); //header('Content-type:text/html;charset=utf-8');

    ### INCLUDE
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/panel/models/User.php";
    require_once "$root/panel/models/Audit.php";
    require_once "$root/panel/models/LogUser.php";
    require_once "$root/panel/models/Response.php";
    require_once "$root/panel/models/Mail.php";
    require_once "$root/panel/models/FisicalPerson.php";
    require_once "$root/panel/models/LegalPerson.php";

	if(isset($_POST['type']) && !empty($_POST['type'])) {
        $type = $_POST['type'];
	}

    $t = new Translate();

//    var_dump(Audit::find("id = 1"));

	//se estiver verificando a nova conta
    if(isset($_POST['account-activate']) && !empty($_POST['account-activate'])) {

        $accountActivate = $_POST['account-activate'];
        $userActivated = User::activateUserAccount($accountActivate);

        if ($userActivated->activated == true){

            Audit::insertAudit($userActivated->id, "Ativou a conta");
            Mail::sendMailUserAccountActivated($userActivated);
            LogUser::addUserLog($user->id, $t->{"Verificação de conta efetuada"});

            $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Sua conta foi verificada com sucesso!"}]);
        }else{
            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Ocorreu um erro ao tentar verificar sua conta. Tente novamente mais tarde."}]);
        }

        echo json_encode($response, JSON_NUMERIC_CHECK);

    }

	if ($type == "sign-in"){

        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);

        $user = User::getUserByUsernameAndPassword($strUsername, $strPassword);

        if ($user == null) {

            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Nome de usuário ou senha incorretos"}]);

        }else{

            if ($user->activated == false){
                $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Verifique seu e-mail para efetuar a ativação da sua conta. Não recebeu o e-mail para ativação? Então, <a class='m--font-info' href='http://localhost/solarbid/panel/login?account-activate=".sha1(md5($user->id))."'>Clique aqui</a>"}]);
            }else{
                session_start();
                $_SESSION['USER'] = serialize($user); //$_SESSION['USER']->username;

                if ($user->registry_type_id == 1){
                    $fisicalPerson = FisicalPerson::find("user_id = '$user->id'");
                    $_SESSION['FISICAL_PERSON'] = serialize($fisicalPerson);
                }else if($user->registry_type_id == 2){
                    $legalPerson = LegalPerson::find("user_id = '$user->id'");
                    $_SESSION['LEGAL_PERSON'] = serialize($legalPerson);
                }

                $content = array("last_seen" => date("Y-m-d H:i:s") , "id" => $user->id);
                User::save($content);

                $inserted = Audit::insertAudit($user->id, "Efetuou login");
                LogUser::addUserLog($user->id, "Efetuou login na plataforma");

                $audit = Audit::find("id = '".$inserted[1]."'"); //inserted[1] tem o id da audit inserida

                Mail::sendMailUserLoggedIn($user, $audit);

                $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Login efetuado com sucesso"}]);
            }
        }

        echo json_encode($response, JSON_NUMERIC_CHECK);

	}else if($type == "sign-up"){

        ### INPUTS
        $registry = ($_POST['registry']);
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);
        $strEmail = strtolower(addslashes($_POST['email']));
        $role = ($_POST['role']);

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
        $existingEmail = User::checkExistingEmail($content[email]);

        if ($existingUsername == false && $existingEmail == false){
            $registered = User::insertUser($content);

            if ($registered != null){

                Audit::insertAudit($registered->id,  "Se cadastrou");
                Mail::sendMailActivateAccountCreation($registered);
                LogUser::addUserLog($user->id, $t->{"Se cadastrou na plataforma"});

                $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Cadastro efetuado com sucesso. Verifique seu e-mail para efetuar a ativação da sua conta."}]);
            }else{
                $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Ocorreu um erro ao criar a sua conta. Tente novamente mais tarde."}]);
            }

        }else{

            if ($existingUsername == true){
                $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Este nome de usuário já está sendo utilizado. Por favor, escolha outro."}]);
            }else if($existingEmail == true){
                $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Este e-mail já está sendo utilizado. Por favor, utilize outro e-mail ou clique em Esqueci minha senha."}]);
            }
        }

        echo json_encode($response, JSON_NUMERIC_CHECK);


	}else if($type == "forgot-password"){


        ### INPUTS
        $strEmail = strtolower(addslashes($_POST['email']));

        $user = User::find("email = '$strEmail'");

        if ($user->email == null){

            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Aviso"}, "description" => $t->{"Não existe nenhum usuário cadastrado com este e-mail. Por favor, verifique o campo de e-mail e tente novamente."}]);
        }else{

            $send = User::sendRecoveryMail($strEmail);

            if ($send) {
                //enviado com sucesso

                LogUser::addUserLog($user->id, $t->{"Requisitou e-mail para alteração de senha"});

                $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"E-mail de redefinição de senha enviado com sucesso. Por favor, verifique sua caixa de e-mail e siga as instruções para redefinir sua senha."}]);
            } else {
                //erro ao enviar

                $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Aviso"}, "description" => $t->{"Ocorreu um erro ao tentar enviar o e-mail de redefinição. Tente novamente mais tarde."}]);
            }

        }

        echo json_encode($response, JSON_NUMERIC_CHECK);
	}
?>
