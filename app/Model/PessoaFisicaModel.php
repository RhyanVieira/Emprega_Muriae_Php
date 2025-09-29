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
        "cpf"  => [
            "label" => 'CPF',
            "rules" => 'required|min:11|max:11'
        ],
        "data_nascimento"  => [
            "label" => 'Data de Nascimento',
            "rules" => 'required|date'
        ],
        "resumo_profissional"  => [
            "label" => 'Resumo Profissional',
            "rules" => 'max:1000'
        ],
        "perfil_publico"  => [
            "label" => 'Perfil Público',
            "rules" => 'required|int'
        ]
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaPessoaFisica()
    {   
        return $this->db->select()->findAll();
    }

}