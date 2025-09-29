<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "curriculum_escolaridade";
    
    public $validationRules = [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:60'
        ],
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCurriculumEscolaridade()
    {   
        return $this->db->select()->findAll();
    }

}