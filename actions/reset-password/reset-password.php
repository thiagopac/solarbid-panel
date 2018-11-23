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

    if ($type == "reset-password"){

        ### INPUTS
        $strPassword = addslashes($_POST['password']);
        $validate = $_POST['validate'];

        $user = new User();
        $param->password = $strPassword;
        $param->hashedId = $validate;

        $response = $user->resetUserPassword($param);
    }

    echo json_encode($response, JSON_NUMERIC_CHECK);

?>