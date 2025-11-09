<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumExperienciaModel extends ModelMain
{
    protected $table = "curriculum_experiencia";
    protected $primaryKey = "curriculum_experiencia_id";
    
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
            "rules" => 'int'
        ],
        "fimAno"  => [
            "label" => 'Ano de Término',
            "rules" => 'int'
        ],
        "estabelecimento"  => [
            "label" => 'Nome da empresa ou estabelecimento',
            "rules" => 'max:60'
        ],
        "cargo_id"  => [
            "label" => 'Cargo',
            "rules" => 'required|int'
        ],
        "cargoDescricao"  => [
            "label" => 'Descrição do cargo',
            "rules" => 'max:60'
        ],
        "atividadesExercidas"  => [
            "label" => 'Atividades Exercidas',
            "rules" => 'max:1000'
        ],
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCurriculumExperiencia()
    {   
        return $this->db->select()->findAll();
    }

    public function getByCurriculumExpId($curriculumId)
    {
        return $this->db->select()
                        ->where('curriculum_id', $curriculumId)
                        ->findAll();
    }

    public function getCurriculumExperienciaById($curriculumExperienciaId)
    {
        return $this->db->select()
                        ->where('curriculum_experiencia_id', $curriculumExperienciaId)
                        ->findAll();
    }

    public function idExclusao($curriculumId, $curriculumExperienciaId)
    {
        return $this->db->select()
                        ->where('curriculum_id', $curriculumId)
                        ->where('curriculum_experiencia_id', $curriculumExperienciaId)
                        ->findAll();
    }
}