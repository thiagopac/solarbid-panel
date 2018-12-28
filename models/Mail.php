<?php

require_once('../../lib/config.php');
require_once('../../lib/class.simple_mail.php');
require_once('../../internationalization/Translate.php');
require_once('../../lib/funcoes.php');
require_once('../../models/Core.php');

class Mail {

    public static function sendMailUserLoggedIn($user, $audit){

        if ($user->mail_notification->loggedIn == false){
            return false;
        }

        $t = new Translate();
        $body = file_get_contents('../../templates/mail/pt-BR/logged-in.html');
        $body = str_replace('{name}', $user->username, $body);
        $body = str_replace('{ip}', $audit->ip, $body);
        $body = str_replace('{date}', fnDateYMDHHIISStoDMYHHIISS($audit->created_at), $body);
        $body = str_replace('{reference}', sha1(md5($user->id)), $body);
        $body = str_replace('{domain}', Core::$domain, $body);
        $body = str_replace('{contact}', Core::$contact, $body);


        $mail = SimpleMail::make()
            ->setTo($user->email, $user->username)
            ->setSubject($t->{"Você efetuou login através de um dispositivo"})
            ->setFrom(Core::$do_not_reply, 'Solarbid')
            ->setReplyTo(Core::$do_not_reply, 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($body)
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailPasswordHasChanged($user){

        if ($user->mail_notification->passwordChanged == false){
            return false;
        }

        $t = new Translate();
        $body = file_get_contents('../../templates/mail/pt-BR/password-changed.html');
        $body = str_replace('{name}', $user->username, $body);
        $body = str_replace('{domain}', Core::$domain, $body);
        $body = str_replace('{contact}', Core::$contact, $body);

        $mail = SimpleMail::make()
            ->setTo($user->email, $user->username)
            ->setSubject($t->{"Sua senha foi alterada"})
            ->setFrom(Core::$do_not_reply, 'Solarbid')
            ->setReplyTo(Core::$do_not_reply, 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($t->{$body})
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailPasswordRedefinition($user){

        $t = new Translate();
        $body = file_get_contents('../../templates/mail/pt-BR/password-redefinition.html');
        $body = str_replace('{name}', $user->username, $body);
        $body = str_replace('{redefinition}', sha1(md5($user->id)), $body);
        $body = str_replace('{domain}', Core::$domain, $body);
        $body = str_replace('{contact}', Core::$contact, $body);

        $mail = SimpleMail::make()
            ->setTo($user->email, $user->username)
            ->setSubject($t->{"Redefinição de senha"})
            ->setFrom(Core::$do_not_reply, 'Solarbid')
            ->setReplyTo(Core::$do_not_reply, 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($body)
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailActivateAccountCreation($user){

        $t = new Translate();

        $t = new Translate();
        $body = file_get_contents('../../templates/mail/pt-BR/account-created.html');
        $body = str_replace('{name}', $user->username, $body);
        $body = str_replace('{activation}', sha1(md5($user->id)), $body);
        $body = str_replace('{domain}', Core::$domain, $body);
        $body = str_replace('{contact}', Core::$contact, $body);

        $mail = SimpleMail::make()
            ->setTo($user->email, $user->username)
            ->setSubject($t->{"Bem-vindo(a) ao Solarbid"})
            ->setFrom(Core::$do_not_reply, 'Solarbid')
            ->setReplyTo(Core::$do_not_reply, 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($body)
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailUserAccountActivated($user){

        $t = new Translate();
        $body = file_get_contents('../../templates/mail/pt-BR/account-activated.html');
        $body = str_replace('{name}', $user->username, $body);
        $body = str_replace('{domain}', Core::$domain, $body);
        $body = str_replace('{contact}', Core::$contact, $body);

        $mail = SimpleMail::make()
            ->setTo($user->email, $user->username)
            ->setSubject($t->{"Sua conta foi ativada"})
            ->setFrom(Core::$do_not_reply, 'Solarbid')
            ->setReplyTo(Core::$do_not_reply, 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($t->{$body})
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

}
