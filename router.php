<?php
    ### VALIDATE SESSION
    session_start();
    if($_SESSION == null) { header("Location: ./login"); }

    $page = $_GET["page"];

    ### INCLUDE
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/panel/models/User.php";
    require_once "$root/panel/internationalization/Translate.php";
    require_once "$root/panel/models/LogUser.php";
    require_once "$root/panel/models/LegalPerson.php";
    require_once "$root/panel/models/NaturalPerson.php";

    $t = new Translate();

    ### USER SESSION
    $user = unserialize($_SESSION['USER']);
    $naturalPerson = unserialize($_SESSION['NATURAL_PERSON']);
    $legalPerson = unserialize($_SESSION['LEGAL_PERSON']);

    switch ($page) {

        case "login":
            session_destroy();
            header("Location: ./login");
            break;

        case "logout":
            LogUser::addUserLog($user->id, $t->{"Fez logout na plataforma"});
            session_destroy();
            header("Location: ./login");
            break;

        case "dashboard":

            $naturalPersonHasEmptyProperty = false;
            $legalPersonHasEmptyProperty = false;

            //check if Natural Person has an empty property to redirect user to setup page
            if ($user->registry_type_id == 1){

                if ($naturalPerson != null) {
                    foreach ($naturalPerson as $key => $value) {
                        if ($value == null){
                            $naturalPersonHasEmptyProperty = true;
                        }
                    }
                }else{
                    $naturalPersonHasEmptyProperty = true;
                }
            }

            //check if Legal Person has an empty property to redirect user to setup page
            if ($user->registry_type_id == 2){

                if ($legalPerson != null) {
                    foreach ($legalPerson as $key => $value) {
                        if ($value == null){
                            $legalPersonHasEmptyProperty = true;
                        }
                    }
                }else{
                    $legalPersonHasEmptyProperty = true;
                }

            }

            if ($user->registry_type_id == 1 && $naturalPersonHasEmptyProperty == true){ //natural person

                //open setup-natural-person

                ### PAGE STRUCTURE SESSION VARS
                $_SESSION['top-menu-admin'] = false;
                $_SESSION['top-quick-search'] = false;
                $_SESSION['top-notifications'] = false;
                $_SESSION['top-quick-actions'] = false;
                $_SESSION['top-profile'] = false;
                $_SESSION['top-quick-sidebar'] = false;
                $_SESSION['menu-left'] = false;

                header("Location: ./main?page=setup-natural-person");
                break;

            }else if ($user->registry_type_id == 2 && $legalPersonHasEmptyProperty == true){ //legal person

                //open setup-legal-person

                ### PAGE STRUCTURE SESSION VARS
                $_SESSION['top-menu-admin'] = false;
                $_SESSION['top-quick-search'] = false;
                $_SESSION['top-notifications'] = false;
                $_SESSION['top-quick-actions'] = false;
                $_SESSION['top-profile'] = false;
                $_SESSION['top-quick-sidebar'] = false;
                $_SESSION['menu-left'] = false;

                header("Location: ./main?page=setup-legal-person");
                break;
            }

            //open dashboard

            ### PAGE STRUCTURE SESSION VARS
            $_SESSION['top-menu-admin'] = $user->role_id == 1 ? true : false;
            $_SESSION['top-quick-search'] = false;
            $_SESSION['top-notifications'] = true;
            $_SESSION['top-quick-actions'] = true;
            $_SESSION['top-profile'] = true;
            $_SESSION['top-quick-sidebar'] = true;
            $_SESSION['menu-left'] = true;

            header("Location: ./main?page=dashboard");
            break;

        case "profile-natural-person":
            ### PAGE STRUCTURE SESSION VARS
            $_SESSION['top-menu-admin'] = $user->role_id == 1 ? true : false;
            $_SESSION['top-quick-search'] = false;
            $_SESSION['top-notifications'] = true;
            $_SESSION['top-quick-actions'] = true;
            $_SESSION['top-profile'] = true;
            $_SESSION['top-quick-sidebar'] = true;
            $_SESSION['menu-left'] = true;
            header("Location: ./main?page=$page");
            break;

        default:
            ### PAGE STRUCTURE SESSION VARS
            $_SESSION['top-menu-admin'] = $user->role_id == 1 ? true : false;
            $_SESSION['top-quick-search'] = false;
            $_SESSION['top-notifications'] = true;
            $_SESSION['top-quick-actions'] = true;
            $_SESSION['top-profile'] = true;
            $_SESSION['top-quick-sidebar'] = true;
            $_SESSION['menu-left'] = true;
            header("Location: ./main?page=$page");

    }
?>