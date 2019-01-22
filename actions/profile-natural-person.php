<?php
    header('Content-type:application/json;charset=utf-8');

    ### VALIDATE SESSION
    session_start();

    ### INCLUDE
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/panel/models/User.php";
    require_once "$root/panel/models/Audit.php";
    require_once "$root/panel/models/LogUser.php";
    require_once "$root/panel/models/Response.php";
    require_once "$root/panel/models/NaturalPerson.php";

    $t = new Translate();

    $user = unserialize($_SESSION['USER']);

    $strFullname = addslashes($_POST['fullname']);
    $strAlias = addslashes($_POST['alias']);
    $strSocialSecurity = fnLeaveOnlyNumbers(addslashes($_POST['social_security']));
    $strPhone = addslashes($_POST['phone']);
    $strStreet = addslashes($_POST['street']);
    $strNumber = addslashes($_POST['number']);
    $strNeighborhood = addslashes($_POST['neighborhood']);
    $strCity = addslashes($_POST['city']);
    $strState = addslashes($_POST['state']);
    $strCountry = addslashes($_POST['country']);

    $contentForm = array();

    $naturalPerson = new NaturalPerson($_POST);

    foreach ($naturalPerson as $property => $value) {

        if ($value != null){
            $contentForm[$property] = $value;
        }
    }

    $completed = NaturalPerson::save($contentForm);

    if ($completed != null){

        //após salvar, gravar o objeto NaturalPerson na sessão do usuário
        $naturalPerson = NaturalPerson::find("user_id = '$user->id'");
        $_SESSION['NATURAL_PERSON'] = serialize($naturalPerson);

        Audit::insertAudit($user->id, "Alterou dados do perfil");
        LogUser::addUserLog($user->id, $t->{"Alterou dados do perfil"});
        $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "description" => $t->{"Dados salvos com sucesso!"}]);

    }else{
        $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Ocorreu um erro ao salvar os dados. Tente novamente mais tarde."}]);
    }

    echo json_encode($response, JSON_NUMERIC_CHECK);

?>