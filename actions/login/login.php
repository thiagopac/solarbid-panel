<?php
	//response only in json_encode
	header('Content-type:application/json;charset=utf-8');
	// header('Content-type:text/html;charset=utf-8');

	### INCLUDE
	require_once('../../lib/config.php');
	require_once('../../internationalization/Translate.php');

	$t = new Translate();

	$type = "sign-in"; //forced value

	if(isset($_POST['type']) && !empty($_POST['type'])) {
        $type = $_POST['type'];
	}

	if ($type == "sign-in"){

        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);

        //Programacao
        $DB = fnDBConn();
        $user = fnDB_USER_INFO($DB,$strUsername,$strPassword);

        $response = new stdClass();

        if ($user == null) {

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
            fnDB_LOG_AUDIT_ADD($DB,'Entrou no sistema.',false);

            $response->status = 1;
            $response->statusMessage = "Dados recuperados com sucesso.";

            $response->type = "success";
            $response->title = "Sucesso";
            $response->description = $t->{"Login efetuado com sucesso"};

            $response->user = $user;
        }
	}else if($type == "sign-up"){

        $response->status = 1;
        $response->statusMessage = "Dados inseridos com sucesso.";

        $response->type = "success";
        $response->title = "Sucesso";
        $response->description = $t->{"Cadastro efetuado com sucesso"};

	}else if($type == "forgot-password"){

        $response->status = 1;
        $response->statusMessage = "E-mail enviado com sucesso.";

        $response->type = "success";
        $response->title = "Sucesso";
        $response->description = $t->{"E-mail para redefinição de senha enviado com sucesso"};

	}

	echo json_encode($response, JSON_NUMERIC_CHECK);
?>
