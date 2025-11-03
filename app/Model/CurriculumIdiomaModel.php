<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumIdiomaModel extends ModelMain
{
    protected $table = "curriculum_idioma";
    protected $primaryKey = "curriculum_idioma_id";

    public $validationRules = [
        "curriculum_id"  => [
            "label" => 'Curriculum Id',
            "rules" => 'required|int'
        ],
        "idioma_id" => [
            "label" => "Idioma",
            "rules" => "required|int"
        ],
        "nivel" => [
        "label" => "Nível",
        "rules" => "int"
        ]
    ];

    public function existeDuplicado($curriculumId, $idiomaId)
    {
        return $this->db
            ->select()
            ->where("curriculum_id", $curriculumId)
            ->where("idioma_id", $idiomaId)
            ->findAll();
    }

    public function getByCurriculumIdiId($curriculumId)
    {
        return $this->db->select()
                        ->where('curriculum_id', $curriculumId)
                        ->findAll();
    }

    public function idExclusao($curriculumId, $curriculumIdiomaId)
    {
        return $this->db->select()
                        ->where('curriculum_id', $curriculumId)
                        ->where('curriculum_idioma_id', $curriculumIdiomaId)
                        ->findAll();
    }
}