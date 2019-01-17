<?php

class Response {

    public $status;
    public $type;
    public $title;
    public $description;
    public $route;

    public function __construct(array $array = []){
        if (!empty($array)) {
            $this->status = $array['status'];
            $this->type = $array['type'];
            $this->title = $array['title'];
            $this->description = $array['description'];
            $this->route = $array['route'];
        }
    }

}