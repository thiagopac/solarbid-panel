<?php
#SETA TIMEOUT
	$PHP_TIMEOUT = 300;
	$MYSQL_TIMEOUT = $PHP_TIMEOUT + 10;

	$GLOBALS['rootpath'] = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']));

	$booDEV = true;

	define('DATABASE_NAME', 'solarbid_panel');

	//definindo hora padrão da aplicacao
	date_default_timezone_set('America/Sao_Paulo');

	//#ERROR REPORT - Reportar erros do PHP
	// ini_set('display_errors', 1);
	// ini_set('log_errors', 1);
	// ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
	// error_reporting(E_ALL);

#DEFAULT
	error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

	// define('FILE_LOG', 'C:\Ampps\www\solarbid\panel\logs\\'.date('Y-m-d')."-solarbid.com_PHP_error.log");
	define('FILE_LOG', '/Applications/AMPPS/www/solarbid/panel/logs/'.date('Y-m-d').'-solarbid.com_PHP_error.log');

	// if ($_SERVER['SERVER_ADMIN'] == 'admin@solarbid.com.br')
	// 	// define('FILE_LOG', '/var/log/www/'.date('Y-m-d').'-solarbid.com_PHP_error.log');
	// 	define('FILE_LOG', 'C:/Ammps/www/solarbid/panel/logs/'.date('Y-m-d')."-solarbid.com_PHP_error.log");
	// else
	// 	define('FILE_LOG', 'C:/Ammps/www/solarbid/panel/logs/'.date('Y-m-d')."-solarbid.com_PHP_error.log");

	set_time_limit($PHP_TIMEOUT);

#ACESSO MYSQL
	$MYSQL_HOST  = "localhost";
	$MYSQL_LOGIN = "root";
	$MYSQL_SENHA = 'mysql';
	$MYSQL_PORTA = 3306;
	$MYSQL_DATABASE = 'solarbid_panel';

//	var_dump($_SERVER['SERVER_NAME']);die;
	if ($_SERVER['SERVER_NAME'] == 'localhost'){
		$MYSQL_HOST  = "localhost";
		$MYSQL_LOGIN = "root";
		$MYSQL_SENHA = "mysql";
		$MYSQL_PORTA = 3306;
		$MYSQL_DATABASE = 'solarbid_panel';
	}

//VARIAVEIS
	$TITULO = "Solarbid";

?>
