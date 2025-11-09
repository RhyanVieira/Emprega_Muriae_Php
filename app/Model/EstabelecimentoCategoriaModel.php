<?php

namespace App\Model;

use Core\Library\ModelMain;

class EstabelecimentoCategoriaModel extends ModelMain
{
    protected $table = "estabelecimento_categoria_estabelecimento";

    public $validationRules = [
        "categoria_estabelecimento_id"  => [
            "rules" => 'required|int'
        ],
        "estabelecimento_id"  => [
            "rules" => 'required|int'
        ],
    ];
}