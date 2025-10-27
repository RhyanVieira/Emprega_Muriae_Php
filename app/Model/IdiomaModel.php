<?php

namespace App\Model;

use Core\Library\ModelMain;

class IdiomaModel extends ModelMain
{
    protected $table = "idioma";
    
    public $validationRules = [
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'required|min:3|max:50'
        ],
    ];

}