<?php

namespace App\Model;

use Core\Library\ModelMain;

class VagaModel extends ModelMain
{
    protected $table = "vaga";
    protected $primaryKey = "vaga_id";
    
    public $validationRules = [
        "cargo_id"  => [
            "label" => 'Cargo Id',
            "rules" => 'required|int'
        ],
        "descricao"  => [
            "label" => 'Título da Vaga',
            "rules" => 'required|min:3|max:60'
        ],
        "sobreaVaga"  => [
            "label" => 'Sobre a Vaga',
            "rules" => 'required|min:3|max:1000'
        ],
        "dtInicio"  => [
            "label" => 'Data de Início',
            "rules" => 'required|date'
        ],
        "dtFim"  => [
            "label" => 'Data de Término',
            "rules" => 'required|date'
        ],
        "estabelecimento_id"  => [
            "label" => 'Estabelecimento',
            "rules" => 'required|int'
        ],
        "cidade_id"  => [
            "label" => 'Cidade',
            "rules" => 'required|int'
        ],
        "modalidade"  => [
            "label" => 'Modalidade de Trabalho',
            "rules" => 'required|int'
        ],
        "vinculo"  => [
            "label" => 'Tipo de contrato',
            "rules" => 'required|int'
        ],
        "statusVaga"  => [
            "label" => 'Status da Vaga',
            "rules" => 'required|int'
        ],
        "nivelExperiencia"  => [
            "label" => 'Nivel de Experiencia',
            "rules" => 'required|int'
        ],
        "faixaSal"  => [
            "label" => 'Faixa Salarial',
            "rules" => 'required'
        ],
        "categoria_vaga_id"  => [
            "label" => 'Categoria da Vaga',
            "rules" => 'required'
        ],
    ];

    public function existeVaga($estabelecimentoId, $descricao, $dtInicio, $dtFim, $modalidade, $vinculo, $nivelExperiencia, $categoria_vaga_id, $faixaSal)
    {
        return $this->db
            ->select()
            ->where("estabelecimento_id", $estabelecimentoId)
            ->where("descricao", $descricao)
            ->where("dtInicio", $dtInicio)
            ->where("dtInicio", $dtInicio)
            ->where("dtFim", $dtFim)
            ->where("modalidade", $modalidade)
            ->where("vinculo", $vinculo)
            ->where("nivelExperiencia", $nivelExperiencia)
            ->where("categoria_vaga_id", $categoria_vaga_id)
            ->where("faixaSal", $faixaSal)
            ->findAll();
    }

    public function vagaHome()
    {
        return $this->db
            ->select("vaga.descricao, cidade.cidade, cidade.uf, estabelecimento.logo, vaga.modalidade, vaga.dtInicio, vaga.dtFim, vaga.vinculo, vaga.faixaSal")
            ->join("cidade", "cidade.cidade_id = vaga.cidade_id")
            ->join("estabelecimento", "estabelecimento.estabelecimento_id = vaga.estabelecimento_id")
            ->where("vaga.statusVaga", 11)
            ->orderBy("vaga.dtInicio", 'DESC')
            ->limit(5)
            ->findAll();
    }

}