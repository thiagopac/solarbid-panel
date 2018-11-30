<?php

class Response
{

    public $status;
    public $type;
    public $title;
    public $description;

    //construtor da classe
    public function __construct(array $array = [])
    {
        //se o array não estiver vazio, inicializar as propriedades do objeto com os valores do array
        if (!empty($array)) {
            $this->status = $array['status'];
            $this->type = $array['type'];
            $this->title = $array['title'];
            $this->description = $array['description'];
        }
    }

}