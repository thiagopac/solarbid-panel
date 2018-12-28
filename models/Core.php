<?php

class Core {

//    public $id;
//    public $version;
//    public $domain;
//    public $contact;
//    public $do_not_reply;
//    public $currency;
//    public $language;

//    protected static $table = "core";

    public static $version = "0.0.1";
    public static $domain = "http://localhost/";
    public static $contact = "contato@solarbid.com.br";
    public static $do_not_reply = "naoresponda@solarbid.com.br";
    public static $currency = "BRL";
    public static $language = "pt-BR";

//    public function __construct($array){
//
//        if (!empty($array)) {
//            $this->id = $array['id'];
//            $this->version = $array['version'];
//            $this->domain = $array['domain'];
//            $this->contact = $array['contact'];
//            $this->do_not_reply = $array['do_not_reply'];
//            $this->currency = $array['currency'];
//            $this->language = $array['language'];
//        }
//    }

//    public function __destruct(){
//
//    }

//    public static function find($parameter) {
//
//        $db = fnDBConn();
//
//        $class = get_called_class();
//        $table = $class::$table;
//        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
//        $sql .= " WHERE {$parameter} ;";
//
//        $result = fnDB_DO_SELECT($db,$sql);
//
//        $obj = new $class($result);
//
//        return $obj;
//    }

}