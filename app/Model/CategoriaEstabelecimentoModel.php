<?php

namespace App\Model;

use Core\Library\ModelMain;

class CategoriaEstabelecimentoModel extends ModelMain
{
    protected $table = "categoria_estabelecimento";
    
    public $validationRules = [
        "estabelecimento_id"  => [
            "label" => 'Estabelecimento Id',
            "rules" => 'required|int'
        ],
        "cateogira_id"  => [
            "label" => 'Categoria Id',
            "rules" => 'required|int'
        ],
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCategoriaEstabelecimento()
    {   
        return $this->db->select()->findAll();
    }

}