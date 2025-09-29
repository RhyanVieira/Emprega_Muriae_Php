<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "curriculum_escolaridade";
    
    public $validationRules = [
        "pessoa_fisica_id"  => [
            "label" => 'Pessoa Física Id',
            "rules" => 'required|int'
        ],
        "vaga_id"  => [
            "label" => 'Vaga Id',
            "rules" => 'required|int'
        ],
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaFavorito()
    {   
        return $this->db->select()->findAll();
    }

}