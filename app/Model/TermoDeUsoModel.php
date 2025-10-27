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


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaTermoDeUso()
    {   
        return $this->db->select()->findAll();
    }

}