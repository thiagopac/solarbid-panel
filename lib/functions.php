<?php

	function fnLogText($strMessage, $booDie = false){
		global $booDEV;

		if ($booDEV) echo $strMessage;

		$fp = fopen(FILE_LOG, 'a');

		fwrite($fp, date("Y/m/d H:i:s") . " - (IP: {$_SERVER['REMOTE_ADDR']})(USER AGENT: {$_SERVER['HTTP_USER_AGENT']})(REQUEST_URI: {$_SERVER['REQUEST_URI']}) -  " . $strMessage . chr(13) . chr(10));
		fclose($fp);

		if ($booDie) {
			die('FALHA GERAL: ' . $strMessage);
		}

	}

	function fnDateDMYtoYMD($param){
		$result = date("Y-m-d", strtotime($param));
		return $result;
	}

	function fnDateYMDtoDMY($param){
		$result = date("d/m/Y", strtotime($param));
		return $result;
	}


	function fnDateDMYHHIISStoYMDHHIISS($param){
		$result = date("Y-m-d H:i:s", strtotime($param));
		return $result;
	}

	function fnDateYMDHHIISStoDMYHHIISS($param){
		$result = date("d/m/Y H:i:s", strtotime($param));
		return $result;
	}

	function fnTimeElapsed($datetime, $full = false, $language) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		if ($language == "pt_BR"){

			$string = array(
				'y' => 'ano',
				'm' => 'mês',
				'w' => 'semana',
				'd' => 'dia',
				'h' => 'hora',
				'i' => 'min',
				's' => 'seg',
			);

			$stringPlural = array(
				'y' => 'ano',
				'm' => 'meses',
				'w' => 'semana',
				'd' => 'dia',
				'h' => 'hora',
				'i' => 'min',
				's' => 'seg',
			);


			foreach ($string as $k => &$v) {
				if ($diff->$k) {

					if ($diff->y < 1 && $diff->m > 1){
						$v = $diff->$k . ' ' . 'meses';
					}else{
						$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
					}
				} else {
					unset($string[$k]);
				}
			}

			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' atrás' : 'agora';
		}else{

			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'min',
				's' => 'sec',
			);

			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}

			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' ago' : 'just now';
		}
	}

	function fnDBConn(){
		global $MYSQL_HOST, $MYSQL_LOGIN, $MYSQL_SENHA, $MYSQL_PORTA, $MYSQL_DATABASE, $MYSQL_TIMEOUT;
		$erro = false;
		$DBtmp = mysqli_connect($MYSQL_HOST, $MYSQL_LOGIN, $MYSQL_SENHA, $MYSQL_DATABASE, $MYSQL_PORTA) or $erro = true;
		if (mysqli_connect_errno()) {
			fnLogText('(fnDBConn) ' . mysqli_connect_errno() , true);
			exit();
		}

		/* change character set to utf8 */
		if (!$DBtmp->set_charset("utf8")) {
			fnLogText('(set_charset) ' . $DBtmp->error, true);
			exit();
		}

		if ($erro) {
			$erro = false;
			sleep(3);
			$DBtmp = mysqli_connect($MYSQL_HOST, $MYSQL_LOGIN, $MYSQL_SENHA, $MYSQL_DATABASE, $MYSQL_PORTA) or $erro = true;
		}

		if ($erro) {
			sleep(3);
			$DBtmp = mysqli_connect($MYSQL_HOST, $MYSQL_LOGIN, $MYSQL_SENHA, $MYSQL_DATABASE, $MYSQL_PORTA) or fnLogText('(fnDBConn) ' . mysqli_connect_error() , true);
		}

		fnDB_DO_EXEC($DBtmp, "SET wait_timeout = {$MYSQL_TIMEOUT}");

		return ($DBtmp);
	}

	function fnDB_DO_EXEC($DB, $strSQL){
		global $DATABASE_NAME, $SQL_DUMP;
		$error = false;
		$SQL_DUMP.= "\n********************************************************************************\n";
		$SQL_DUMP.= $strSQL;
		$qy = mysqli_query($DB, $strSQL) or $error = true;

		if ($error) fnLogText('(fnDB_DO_EXEC) MySQL Error: ' . mysqli_error($DB) . ' (SQL: ' . $strSQL . ')', true);

		return (array(
			(int)$DB->affected_rows,
			(int)mysqli_insert_id($DB),
			$error
		));
	}

	function fnDB_DO_SELECT_WHILE($DB, $strSQL){
		global $DATABASE_NAME, $SQL_DUMP;
		$error = false;
		$SQL_DUMP.= "\n********************************************************************************\n";
		$SQL_DUMP.= $strSQL;
		$qy = mysqli_query($DB, $strSQL) or $error = true;

		if ($error) fnLogText('(fnDB_DO_SELECT_WHILE) MySQL Error: ' . mysqli_error($DB) . ' (SQL: ' . $strSQL . ')', true);
		$arItem = array();
		$i = 0;

		while ($linha = mysqli_fetch_assoc($qy)) {
			$arItem[$i] = $linha;
			$i++;
		}

		return ($arItem);
	}

	function fnDB_DO_SELECT($DB, $strSQL){
		global $DATABASE_NAME, $SQL_DUMP;
		$SQL_DUMP.= "\n********************************************************************************\n";
		$SQL_DUMP.= $strSQL;
		$error = false;
		$qy = mysqli_query($DB, $strSQL) or $error = true;

		if ($error) fnLogText('(fnDB_DO_SELECT) MySQL Error: ' . mysqli_error($DB) . ' (SQL: ' . $strSQL . ')', true);

		$linha = mysqli_fetch_assoc($qy);

		return ($linha);
	}

	function fnValidaChars($texto){
		$arCHARS_VALIDOS = array(
			'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', ' ', ',', '.', ':', ';', '?', '!', '(', ')', '=', '/', '*', '$', '-', '+', '%', '#', '@'
		);

		$texto = strtolower($texto);

		for ($x = 0; $x < strlen($texto); $x++) {
			if (!in_array($texto[$x], $arCHARS_VALIDOS)) return ($texto[$x]);
		}

		return (true);
	}

	function RemoveAcentos($string = ""){
		if ($string != "") {
			$com_acento = "Ã¡ Ã  Ã£ Ã¢ Ã¤ Ã© Ã¨ Ãª Ã« Ã­ Ã¬ Ã® Ã¯ Ã³ Ã² Ã´ Ãµ Ã¶ Ãº Ã¹ Ã» Ã¼ Ã� Ã€ Ãƒ Ã‚ Ã„ Ã‰ Ãˆ ÃŠ Ã‹ Ã� ÃŒ ÃŽ Ã� Ã“ Ã’ Ã• Ã�? Ã– Ãš Ã™ Ã› Ãœ Ã§ Ã‡ Ã± Ã‘";
			$sem_acento = "a a a a a e e e e i i i i o o o o o u u u u A A A A A E E E E I I I I O O O O O U U U U c C n N";
			$c = explode(' ', $com_acento);
			$s = explode(' ', $sem_acento);
			$i = 0;

			foreach($c as $letra) {
				/**
				 * @todo Trocar ereg por preg_match
				 */
				if (@ereg($letra, $string)) {
					$pattern[] = $letra;
					$replacement[] = $s[$i];
				}
				$i = $i + 1;
			}

			if (isset($pattern)) {
				$i = 0;
				foreach($pattern as $letra) {
					$string = eregi_replace($letra, $replacement[$i], $string);
					$i = $i + 1;
				}

				return $string; // retorna string alterada
			}

			return $string; // retorna a mesma string se nada mudou
		}
	}

	function pwStrongCheck($pwd){
		$error = false;

		if (strlen($pwd) < 8){  //to short
			$error = true;
		}

		/*if(strlen($pwd) > 20){ //to long
		$error = true;
		}*/

		if (!preg_match("#[0-9]+#", $pwd)){ //at least one number
			$error = true;
		}

		if (!preg_match("#[a-z]+#", $pwd)){ //at least one letter
			$error = true;
		}

		/*if(!preg_match("#[A-Z]+#", $pwd)){ //at least one capital letter
		$error = true;
		}*/

		// if(!preg_match("#\W+#", $pwd)){ //at least one symbol
		// 	$error = true;
		// }

		return $error;
	}

	function fnRemoveAcentos($str, $enc = "UTF-8"){
		$str = str_replace('"', ' ', $str);
		$str = str_replace('Â´', ' ', $str);
		$str = str_replace("'", ' ', $str);
		$str = str_replace("Â¨", ' ', $str);
		$str = str_replace("~", ' ', $str);
		$str = str_replace("^", ' ', $str);
		$acentos = array(
			'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
			'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
			'C' => '/&Ccedil;/',
			'c' => '/&ccedil;/',
			'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
			'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
			'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
			'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
			'N' => '/&Ntilde;/',
			'n' => '/&ntilde;/',
			'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
			'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
			'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
			'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
			'Y' => '/&Yacute;/',
			'y' => '/&yacute;|&yuml;/',
			'a.' => '/&ordf;/',
			'o.' => '/&ordm;/'
		);
		return preg_replace($acentos, array_keys($acentos) , htmlentities($str, ENT_NOQUOTES, $enc));
	}

	function consoleLog($data) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);

		echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}

	function fnLeaveOnlyNumbers($string){
		return preg_replace("/[^0-9]/", "", $string);
	}

?>
