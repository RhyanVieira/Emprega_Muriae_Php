<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "curriculum_escolaridade";
    
    public $validationRules = [
        "curriculum_id"  => [
            "label" => 'Curriculum Id',
            "rules" => 'required|int'
        ],
        "inicioMes"  => [
            "label" => 'Mês de início',
            "rules" => 'required|int'
        ],
        "inicioAno"  => [
            "label" => 'Ano de início',
            "rules" => 'required|int'
        ],
        "fimMes"  => [
            "label" => 'Mês de término',
            "rules" => 'required|int'
        ],
        "fimAno"  => [
            "label" => 'Ano de Término',
            "rules" => 'required|int'
        ],
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'required|min:3|max:60'
        ],
        "instituicao"  => [
            "label" => 'Instituição',
            "rules" => 'required|min:3|max:60'
        ],
        "cidade_id"  => [
            "label" => 'Cidade',
            "rules" => 'required|int'
        ],
        "escolaridade_id"  => [
            "label" => 'Escolaridade',
            "rules" => 'required|int'
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