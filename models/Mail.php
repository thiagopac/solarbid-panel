<?php

require_once('../../lib/config.php');
require_once('../../lib/class.simple_mail.php');
require_once('../../internationalization/Translate.php');

class Mail
{

    public static function sendMailPasswordHasChanged($toEmail, $toName, $user){

        if ($user->mail_notification->passwordChanged == false){
            return false;
        }

        $t = new Translate();

        $mail = SimpleMail::make()
            ->setTo($toEmail, $toName)
            ->setSubject($t->{"Sua senha foi alterada"})
            ->setFrom('naoresponda@solarbid.com.br', 'Solarbid')
            ->setReplyTo('naoresponda@solarbid.com.br', 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($t->{'<p>Esta &eacute; uma mensagem de seguran&ccedil;a. Voc&ecirc; alterou sua senha. Caso voc&ecirc; n&atilde;o tenha efetuado a troca de senha, por favor entre em contato conosco atrav&eacute;s do endere&ccedil;o <a href="mailto:contato@solarbid.com.br">contato@solarbid.com.br</a></p>'})
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailPasswordRedefinition($toEmail, $toName, $validate){

        $t = new Translate();

        $mail = SimpleMail::make()
            ->setTo($toEmail, $toName)
            ->setSubject($t->{"Redefinição de senha"})
            ->setFrom('naoresponda@solarbid.com.br', 'Solarbid')
            ->setReplyTo('naoresponda@solarbid.com.br', 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage('<p>Voc&ecirc; est&aacute; recebendo este e-mail devido a sua solicita&ccedil;&atilde;o de redefini&ccedil;&atilde;o de senha.<br/><br/>Para gerar uma nova senha, por favor acesse a seguinte URL:</p><p><a href="http://localhost/solarbid/panel/reset-password?validate='.$validate.'">http://localhost/solarbid/panel/reset-password?validate='.$validate.'</a></p><p>Caso voc&ecirc; n&atilde;o tenha requisitado a redefini&ccedil;&atilde;o de senha, apenas ignore este e-mail.</p>')
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailUserLoggedIn($user){

        if ($user->mail_notification->loggedIn == false){
            return false;
        }

        $t = new Translate();
        $body = file_get_contents('../../templates/mail/pt-BR/logged-in.html');
        $body = str_replace('{name}', $user->username, $body);

        $mail = SimpleMail::make()
            ->setTo($user->email, $user->username)
            ->setSubject($t->{"Você efetuou login através de um dispositivo"})
            ->setFrom('naoresponda@solarbid.com.br', 'Solarbid')
            ->setReplyTo('naoresponda@solarbid.com.br', 'Solarbid')
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

        $mail = SimpleMail::make()
            ->setTo($user->email, $user->username)
            ->setSubject($t->{"Bem-vindo(a) ao Solarbid"})
            ->setFrom('naoresponda@solarbid.com.br', 'Solarbid')
            ->setReplyTo('naoresponda@solarbid.com.br', 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($body)
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailUserAccountActivated($toEmail, $toName){

        $t = new Translate();

        $mail = SimpleMail::make()
            ->setTo($toEmail, $toName)
            ->setSubject($t->{"Sua conta foi verificada"})
            ->setFrom('naoresponda@solarbid.com.br', 'Solarbid')
            ->setReplyTo('naoresponda@solarbid.com.br', 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($t->{'<p>Sua conta Solarbid foi verificada com sucesso! Acesse o site e continue seu cadastro.</p>'})
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

}
