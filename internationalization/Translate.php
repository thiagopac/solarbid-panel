<?php
// include("./lib/funcoes.php");

class Translate {
	// idioma atual
	public $lang;

	function __construct() {

		if ($_SESSION['USER']->LANGUAGE_ID != null) {

            if ($_SESSION['USER']->LANGUAGE_ID == 1) {
            $this->lang = "pt_BR";
            }else if($_SESSION['USER']->LANGUAGE_ID == 2){
            $this->lang = "en_US";
            }

		}else{
			$this->lang = "pt_BR"; //pt-BR é o idioma padrão
		}

		if (file_exists("internationalization/'.$this->lang.'.json") == true){
			$this->_= json_decode(file_get_contents("internationalization/'.$this->lang.'.json"), true);
		}else if (file_exists("./internationalization/".$this->lang.".json") == true){
            $this->_= json_decode(file_get_contents("./internationalization/".$this->lang.".json"), true);
		}else if (file_exists("../internationalization/".$this->lang.".json") == true){
			$this->_= json_decode(file_get_contents("../internationalization/".$this->lang.".json"), true);
		}else if (file_exists("../../internationalization/".$this->lang.".json") == true){
			$this->_= json_decode(file_get_contents("../../internationalization/".$this->lang.".json"), true);
		}else if (file_exists("../../../internationalization/".$this->lang.".json") == true){
			$this->_= json_decode(file_get_contents("../../../internationalization/".$this->lang.".json"), true);
		}else if (file_exists("../../../../internationalization/".$this->lang.".json") == true){
			$this->_= json_decode(file_get_contents("../../../../internationalization/".$this->lang.".json"), true);
		}else if (file_exists("../../../../../internationalization/".$this->lang.".json") == true){
			$this->_= json_decode(file_get_contents("../../../../../internationalization/".$this->lang.".json"), true);
		}


	}

	function __get($text) {
		return isset($this->_[$text]) ? $this->_[$text] : $text;
	}
}
?>
