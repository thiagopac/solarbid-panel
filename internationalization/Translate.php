<?php
// include("./lib/funcoes.php");

class Translate {
	// idioma atual
	public $lang;

	function __construct() {

		if ($_SESSION['USER']->LANGUAGE_ID != null) {

            if ($_SESSION['USER']->LANGUAGE_ID == 1) {
            $this->lang = "pt-BR";
            }else if($_SESSION['USER']->LANGUAGE_ID == 2){
            $this->lang = "en-US";
            }

		}else{
			$this->lang = "pt-BR"; //pt-BR é o idioma padrão
		}


        $fileExists = file_exists("../../internationalization/'.$this->lang.'.json");

		if ($fileExists == true){
            $this->_= json_decode(file_get_contents('../../internationalization/'.$this->lang.'.json'), true);
		}else{
            $this->_= json_decode(file_get_contents('../../../internationalization/'.$this->lang.'.json'), true);
		}


	}

	function __get($text) {
		return isset($this->_[$text]) ? $this->_[$text] : $text;
	}
}
?>
