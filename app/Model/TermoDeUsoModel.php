<?php

namespace App\Model;

use Core\Library\ModelMain;

class TermoDeUsoModel extends ModelMain
{
    protected $table = "termodeuso";
    
    public $validationRules = [
        "textoTermo"  => [
            "label" => 'Texto do Termo de Uso',
            "rules" => 'required'
        ],
        "statusRegistro"  => [
            "label" => 'Status',
            "rules" => 'required|int'
        ],
        "rascunho"  => [
            "label" => 'Rascunho',
            "rules" => 'required|int'
        ],
        "usuario_id"  => [
            "label" => 'Usuário',
            "rules" => 'required|int'
        ],
    ];

    public function getUltimoTermoAtivo()
    {
        return $this->db
            ->select("id")
            ->where("statusRegistro", 1)
            ->where("rascunho", 2)
            ->orderBy("id", "DESC")
            ->limit(1)
            ->first();
    }

}