<?php
    header('Content-type:application/json;charset=utf-8'); //header('Content-type:text/html;charset=utf-8');

    ### INCLUDE
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/panel/models/User.php";
    require_once "$root/panel/models/Response.php";

    $t = new Translate();

    var_dump($_POST);

    $name = $_POST['name'];
    $value = $_POST['value'];

    $strNotification = "Criar json com o ajuste alterado";

//    $content = array("mail_notification" => $hpassword, "id" => $affectedUser->id);

//
//    $user = User::getUserByUsernameAndPassword($strUsername, $strPassword);
//
//    if ($user == null) {
//
//        $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Nome de usuário ou senha incorretos"}]);
//
//    }else{
//
//        if ($user->activated == false){
//            $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Verifique seu e-mail para efetuar a ativação da sua conta. Não recebeu o e-mail para ativação? Então, <a class='m--font-info' href='http://localhost/solarbid/panel/login?account-activate=".sha1(md5($user->id))."'>Clique aqui</a>"}]);
//        }else{
//            session_start();
//            $_SESSION['USER'] = serialize($user); //$_SESSION['USER']->username;
//
//            $inserted = Audit::insertAudit($user->id, "Efetuou login");
//            LogUser::addUserLog($user->id, "Efetuou login na plataforma");
//
//            $audit = Audit::find("id = '".$inserted[1]."'"); //inserted[1] tem o id da audit inserida
//
//            Mail::sendMailUserLoggedIn($user, $audit);
//
//            $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Login efetuado com sucesso"}]);
//        }
//    }
//
//    echo json_encode($response, JSON_NUMERIC_CHECK);
?>