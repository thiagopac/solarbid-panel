<?php
    header('Content-type:application/json;charset=utf-8'); //header('Content-type:text/html;charset=utf-8');

    session_start();

    ### INCLUDE
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/panel/models/User.php";
    require_once "$root/panel/models/Response.php";

    $t = new Translate();

    $name = $_POST['name'];
    $value = $_POST['value'];

    $user = unserialize($_SESSION['USER']);
    $refreshedUser = User::getUserById($user->id);

    foreach ($refreshedUser->mail_notification as $notification) {
        if ($notification->name == $name){
            $notification->state = $value == "true" ? true : false;
        }
    }

    $content = array("mail_notification" => json_encode($refreshedUser->mail_notification), "id" => $user->id);
//    var_dump(json_encode($refreshedUser->mail_notification));

    $result = User::save($content);

    if ($result == null) {
        $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Problema ao salvar"}]);
    }else{
        $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Configurações salvas"}]);
    }

    echo json_encode($response, JSON_NUMERIC_CHECK);
?>