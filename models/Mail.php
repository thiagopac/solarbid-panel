<?php

require_once('../../lib/config.php');
require_once('../../lib/class.simple_mail.php');
require_once('../../internationalization/Translate.php');

class Mail
{

    public static function sendMailPasswordHasChanged($toEmail, $toName, $user){

        if ($user->mailNotification->passwordchanged == false){
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

    public static function sendMailUserLoggedIn($toEmail, $toName, $user){

        if ($user->mailNotification->loggedIn == false){
            return false;
        }

        $t = new Translate();

        $mail = SimpleMail::make()
            ->setTo($toEmail, $toName)
            ->setSubject($t->{"Você efetuou login através de um dispositivo"})
            ->setFrom('naoresponda@solarbid.com.br', 'Solarbid')
            ->setReplyTo('naoresponda@solarbid.com.br', 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage($t->{'<p>Esta &eacute; uma mensagem de seguran&ccedil;a. Voc&ecirc; efetuou login em um de seus dispositivos. Caso voc&ecirc; n&atilde;o tenha sido voc&ecirc;, considere efetuar a troca de sua senha.</p>'})
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailVerifyAccountCreation($toEmail, $toName, $accountVerify){

        $t = new Translate();

        $mail = SimpleMail::make()
            ->setTo($toEmail, $toName)
            ->setSubject($t->{"Bem-vindo(a) ao Solarbid"})
            ->setFrom('naoresponda@solarbid.com.br', 'Solarbid')
            ->setReplyTo('naoresponda@solarbid.com.br', 'Solarbid')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
            ->setHtml()
            ->setMessage('<p>Bem-vindo(a) ao Solarbid.<br/><br/>Voc&ecirc; est&aacute; recebendo este e-mail pois se cadastrou na plataforma Solarbid.</p><p>Para continuar o processo e ter acesso a nossas ferramentas, &eacute; necess&aacute;rio a verifica&ccedil;&atilde;o de sua conta, clicando no endere&ccedil;o abaixo ou copiando e colando o link na barra de endere&ccedil;os de seu navegador.</p><p><a href="http://localhost/solarbid/panel/login?account-verify='.$accountVerify.'">http://localhost/solarbid/panel/login?account-verify='.$accountVerify.'</a></p><p>Caso voc&ecirc; n&atilde;o tenha se cadastrado em nossa plataforma e tenha recebido esta mensagem por engano, por favor ignore este e-mail.</p>')
            ->setWrap(78);
        $send = $mail->send();

        //echo $mail->debug();

        return $send;
    }

    public static function sendMailUserAccountVerified($toEmail, $toName){

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