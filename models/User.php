<?php

include_once 'ActiveRecord.php';

class User extends ActiveRecord {

    public $id;
    public $username;
    public $password;
    public $email;
    public $mail_notification;
    public $created_at;
    public $updated_at;
    public $role_id;
    public $activated;

    protected $logTimestamp = TRUE;

//    public static function listarRecentes(int $dias = 10)
//    {
//        return self::all("created_at >= '" . date('Y-m-d h:m:i', strtotime("-{$dias} days")) . "'");
//    }

    public static function numTotal(){
        return self::count();
    }

    public static function getUserWithCredentials(string $username, string $password){

        $userArr = self::all("username = '$username'");

        $user = json_decode(json_encode((object) $userArr[0]), FALSE);

        $access = password_verify($password, $user->password);

        unset($user->password); //retirar o password do objeto de retorno

        return $access == true ? $user : null;
    }

}