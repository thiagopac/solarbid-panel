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
    require_once "$root/panel/models/LegalPerson.php";

    $t = new Translate();

    $user = unserialize($_SESSION['USER']);

    $strTradingName = addslashes($_POST['trading_name']);
    $strCompanyName = addslashes($_POST['company_name']);
    $strRegisteredNumber = fnLeaveOnlyNumbers(addslashes($_POST['registered_number']));
    $strPhone = addslashes($_POST['phone']);
    $strContactFullname = addslashes($_POST['contact_fullname']);
    $strContactEmail = addslashes($_POST['contact_email']);
    $strContactPhone = addslashes($_POST['contact_phone']);
    $strStreet = addslashes($_POST['street']);
    $strNumber = addslashes($_POST['number']);
    $strNeighborhood = addslashes($_POST['neighborhood']);
    $strCity = addslashes($_POST['city']);
    $strState = addslashes($_POST['state']);
    $strCountry = addslashes($_POST['country']);
    $terms = addslashes($_POST['terms_of_use']);
    $privacy = addslashes($_POST['privacy_policy']);

    $existing = LegalPerson::find("user_id = '$user->id'");

    $contentForm = array("trading_name" => $strTradingName, "company_name" => $strCompanyName, "registered_number" => $strRegisteredNumber, "phone" => $strPhone, "contact_fullname" => $strContactFullname,
        "contact_email" => $strContactEmail, "contact_phone" => $strContactPhone, "street" => $strStreet,  "number" => $strNumber, "neighborhood" => $strNeighborhood, "city" => $strCity, "state" => $strState,
        "country" => $strCountry, "user_id" => $user->id);

    if ($existing) { $contentForm['id'] = $existing->id; } //se já existir o LegalPerson para aquele usuário, adicionar o id para efetuar update

    $completed = LegalPerson::save($contentForm);

    if ($completed != null){

        //após salvar, gravar o objeto LegalPerson na sessão do usuário
        $legalPerson = LegalPerson::find("user_id = '$user->id'");
        $_SESSION['LEGAL_PERSON'] = serialize($legalPerson);

        //salvar na tabela de usuário os Termos de Uso e política de privacidade que o usuário concordou
        $contentAgreements = array("terms_of_use_id" => $terms, "privacy_policy_id" => $privacy, "id" => $user->id);
        User::save($contentAgreements);

        Audit::insertAudit($user->id, "Concluiu o cadastro da conta");
        LogUser::addUserLog($user->id, $t->{"Concluiu o cadastro da conta"});
        $response = new Response(["status" => "1", "type" => "success", "title" => $t->{"Sucesso"}, "route" => "./router?page=dashboard", "description" => $t->{"Sua conta foi concluída com sucesso!"}]);

    }else{
        $response = new Response(["status" => "2", "type" => "danger", "title" => $t->{"Erro"}, "description" => $t->{"Ocorreu um erro ao salvar os dados. Tente novamente mais tarde."}]);
    }

    echo json_encode($response, JSON_NUMERIC_CHECK);

?>