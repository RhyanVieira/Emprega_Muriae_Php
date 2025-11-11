<?php

namespace App\Model;

use Core\Library\ModelMain;

class TermoDeUsoAceiteModel extends ModelMain
{
    protected $table = "termodeusoaceite";

    public $validationRules = [
        "termodeuso_id"  => [
            "label" => "Termo de Uso",
            "rules" => 'required|int'
        ],
        "usuario_id"  => [
            "label" => "Usuário",
            "rules" => 'required|int'
        ],
        "dataHoraAceite" => [
            "label" => "Data do Aceite", 
            "rules" => "datetime"
        ]
    ];
}