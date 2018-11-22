<?php
	//response only in json_encode
	header('Content-type:application/json;charset=utf-8');
//	 header('Content-type:text/html;charset=utf-8');

	### INCLUDE
	require_once('../../lib/config.php');
	require_once('../../internationalization/Translate.php');
	require_once('../../models/User.php');
    require_once('../../models/Audit.php');

	$t = new Translate();

	$type = "sign-in"; //forced value

	if(isset($_POST['type']) && !empty($_POST['type'])) {
        $type = $_POST['type'];
	}

//    echo json_encode($_POST, JSON_NUMERIC_CHECK);
//	exit;

    $response = new stdClass();

	if ($type == "sign-in"){

        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);

        //Programacao
        $DB = fnDBConn();

        $password_enc = password_hash($strPassword, PASSWORD_DEFAULT);

        $user = new User();
        $param->username = $strUsername;

        $user = $user->getUserWithUsername($param);

        $access = password_verify($strPassword, $user->password); //password é um hash possível do que foi recebido

        unset($user->password);

        if ($access == false) {

            $response->status = 2;
            $response->statusMessage = "Não foi possível recuperar os dados.";

            $response->type = "error";
            $response->title = "Erro";
            $response->description = $t->{"Nome de usuário ou senha incorretos"};

        }else{

            //Inicia a sessao
            session_start();
            $_SESSION['USER'] = $user;

            //Adiciona registro na tabela de auditoria
            $audit = new Audit();

            $params->userId = $user->id;
            $params->actionDesc = "Efetuou login no Painel";
            $audit->insertAudit($params);

            $response->status = 1;
            $response->statusMessage = "Dados recuperados com sucesso.";

            $response->type = "success";
            $response->title = "Sucesso";
            $response->description = $t->{"Login efetuado com sucesso"};

            $response->user = $user;
        }

	}else if($type == "sign-up"){

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

        $user = new User();
        $param->username = $strUsername;
        $param->password = $strPassword;
        $param->email = $strEmail;
        $param->roleId = $roleId;
        $param->languageId = $languageId;
        $param->countryId = $countryId;

        $insertedUser = $user->insertUser($param);

//        var_dump($insertedUser);

//        CRIAR UMA CLASSE DE RESPONSE E USAR ELA PRA CRIAR A RESPOSTA A SER ENVIADA PARA OS CONTROLLERS,
//        FAZENDO OS PROBLEMAS DE SQL OU OUTROS CONTROLES, SEREM EXPOSTOS NAS MENSAGENS DE RETORNO PARA O USUÁRIO,
//        NÃO PRECISANDO FAZER CONTROLE PELOS TIPOS DE RETONO NOS CONTROLLERS.

        if ($insertedUser->id == null){

            $response->status = 2;
            $response->statusMessage = "Não foi possível inserir os dados.";

            $response->type = "error";
            $response->title = "Erro";
            $response->description = $t->{"Ocorreu um erro ao criar a sua conta. Tente novamente mais tarde."};

        }else{

            $response->status = 1;
            $response->statusMessage = "Dados inseridos com sucesso.";

            $response->type = "success";
            $response->title = "Sucesso";
            $response->description = $t->{"Cadastro efetuado com sucesso"};
        }

	}else if($type == "forgot-password"){

        $response->status = 1;
        $response->statusMessage = "E-mail enviado com sucesso.";

        $response->type = "success";
        $response->title = "Sucesso";
        $response->description = $t->{"E-mail para redefinição de senha enviado com sucesso"};

	}

	echo json_encode($response, JSON_NUMERIC_CHECK);
?>
