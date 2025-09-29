<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "cidade";
    
    public $validationRules = [
        "cidade"  => [
            "label" => 'Cidade',
            "rules" => 'required|min:3|max:200'
        ],
        "uf"  => [
            "label" => 'UF',
            "rules" => 'required|min:2|max:2'
        ],
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCidade()
    {   
        return $this->db->select()->findAll();
    }

}