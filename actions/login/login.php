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
        $param->password = $strPassword;

        $response = $user->getUserWithCredentials($param);

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

        $response = $user->insertUser($param);

	}else if($type == "forgot-password"){

        $response->status = 1;
        $response->statusMessage = "E-mail enviado com sucesso.";

        $response->type = "success";
        $response->title = "Sucesso";
        $response->description = $t->{"E-mail para redefinição de senha enviado com sucesso"};

	}

	echo json_encode($response, JSON_NUMERIC_CHECK);
?>
