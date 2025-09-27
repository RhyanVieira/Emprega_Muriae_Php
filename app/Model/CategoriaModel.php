<?php

namespace App\Model;

use Core\Library\ModelMain;

class CategoriaModel extends ModelMain
{
    protected $table = "categoria";
    
    public $validationRules = [
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'required|min:0|max:50'
        ],
        "icone"  => [
            "label" => 'Ícone',
            "rules" => 'required|min:0|max:50'
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