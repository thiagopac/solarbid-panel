<?php
    //response only in json_encode
    header('Content-type:application/json;charset=utf-8'); //header('Content-type:text/html;charset=utf-8');

    ### INCLUDE
    require_once('../../models/User.php');
    require_once('../../internationalization/Translate.php');

    $t = new Translate();

    $type = "sign-in"; //forced value

    if(isset($_POST['type']) && !empty($_POST['type'])) {
        $type = $_POST['type'];
    }

    $response = new stdClass();

    if ($type == "reset-password"){

        ### INPUTS
        $strPassword = addslashes($_POST['password']);
        $validate = $_POST['validate'];

        $user = User::resetUserPassword($strPassword, $validate);

        if ($user != null){

//            Audit::insertAudit(["userId" => $affectedUser->id, "actionDesc" => "Alterou a senha"]);

            Mail::sendMailPasswordHasChanged($affectedUser->email, $affectedUser->username, $affectedUser);

            $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Senha alterada com sucesso! Você está sendo redirecionado para a página de login."}]);

        }else{

            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Ocorreu um erro ao tentar alterar sua senha. Tente novamente mais tarde."}]);
        }

        echo json_encode($response, JSON_NUMERIC_CHECK);

    }

?>