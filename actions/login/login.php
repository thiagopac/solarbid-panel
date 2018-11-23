<?php
    //response only in json_encode
    header('Content-type:application/json;charset=utf-8');
    //header('Content-type:text/html;charset=utf-8');

	### INCLUDE
	require_once('../../models/User.php');

	$type = "sign-in"; //forced value

	if(isset($_POST['type']) && !empty($_POST['type'])) {
        $type = $_POST['type'];
	}

    $response = new stdClass();

	if ($type == "sign-in"){

        ### INPUTS
        $strUsername = strtolower(addslashes($_POST['username']));
        $strPassword = addslashes($_POST['password']);

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

        ### INPUTS
        $strEmail = strtolower(addslashes($_POST['email']));

        $user = new User();
        $param->email = $strEmail;

        $response = $user->sendRecoveryMail($param);
	}

	echo json_encode($response, JSON_NUMERIC_CHECK);
?>
