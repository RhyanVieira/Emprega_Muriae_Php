<?php

namespace App\Model;

use Core\Library\ModelMain;

class TipoContratoModel extends ModelMain
{
    protected $table = "tipo_contrato";
    
    public $validationRules = [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:60'
        ]
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaTipoContrato()
    {   
        return $this->db->select()->findAll();
    }

}