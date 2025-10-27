<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumQualificacaoModel extends ModelMain
{
    protected $table = "curriculum_qualificacao";
    
    public $validationRules = [
        "curriculum_id"  => [
            "label" => 'Curriculum Id',
            "rules" => 'required|int'
        ],
        "mes"  => [
            "label" => 'Mês',
            "rules" => 'required|int'
        ],
        "ano"  => [
            "label" => 'Ano',
            "rules" => 'required|int'
        ],
        "cargaHoraria"  => [
            "label" => 'Carga Horária',
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
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCurriculumQualificacao()
    {   
        return $this->db->select()->findAll();
    }

}