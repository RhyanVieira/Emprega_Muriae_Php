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
        "responsabilidades"  => [
            "label" => 'Responsabilidades do Candidato',
            "rules" => 'required|min:3|max:1000'
        ],
        "requisitos"  => [
            "label" => 'Requisitos da Vaga',
            "rules" => 'required|min:3|max:1000'
        ],
        "beneficios"  => [
            "label" => 'Benefícios',
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
            ->select("vaga.vaga_id, vaga.descricao, cidade.cidade, cidade.uf, estabelecimento.logo, vaga.modalidade, vaga.dtInicio, vaga.dtFim, vaga.vinculo, vaga.faixaSal, vaga.nivelExperiencia")
            ->join("cidade", "cidade.cidade_id = vaga.cidade_id")
            ->join("estabelecimento", "estabelecimento.estabelecimento_id = vaga.estabelecimento_id")
            ->where("vaga.statusVaga", 11)
            ->orderBy("vaga.dtInicio", 'ASC')
            ->limit(5)
            ->findAll();
    }

    public function getVagaPorId($id)
    {
        return $this->db
            ->select("
                vaga.*,
                e.nome AS empresa,
                e.logo,
                c.cidade,
                c.uf,
                ca.descricao AS cargo,
                cv.descricao AS categoria
            ")
            ->join("estabelecimento AS e", "e.estabelecimento_id = vaga.estabelecimento_id", "INNER")
            ->join("cidade AS c", "c.cidade_id = vaga.cidade_id", "LEFT")
            ->join("cargo AS ca", "ca.cargo_id = vaga.cargo_id", "LEFT")
            ->join("categoria_vaga AS cv", "cv.categoria_vaga_id = vaga.categoria_vaga_id", "LEFT")
            ->where("vaga.vaga_id", $id)
            ->first();
    }

    public function listarVagasPorEmpresa($empresaId, $limite, $offset)
    {
        return $this->db
            ->select("
                vaga.vaga_id,
                vaga.descricao,
                vaga.dtInicio,
                vaga.dtFim,
                vaga.statusVaga,
                vaga.faixaSal,
                vaga.modalidade,
                vaga.vinculo,
                vaga.nivelExperiencia,
                c.cidade,
                c.uf
            ")
            ->join("cidade AS c", "c.cidade_id = vaga.cidade_id", "LEFT")
            ->where("vaga.estabelecimento_id", $empresaId)
            ->orderBy("vaga.dtInicio", "ASC")
            ->limit($limite)
            ->offset($offset)
            ->findAll();
    }

    public function listarVagasAbertasPorEmpresa($empresaId, $limite, $offset)
    {
        return $this->db
            ->select("
                vaga.vaga_id,
                vaga.descricao,
                vaga.dtInicio,
                vaga.dtFim,
                vaga.statusVaga,
                vaga.faixaSal,
                vaga.modalidade,
                vaga.vinculo,
                vaga.nivelExperiencia,
                c.cidade,
                c.uf
            ")
            ->join("cidade AS c", "c.cidade_id = vaga.cidade_id", "LEFT")
            ->where("vaga.estabelecimento_id", $empresaId)
            ->where("vaga.statusVaga", 11)
            ->orderBy("vaga.dtInicio", "ASC")
            ->limit($limite)
            ->offset($offset)
            ->findAll();
    }

    public function countVagasAbertasPorEmpresa($empresaId)
    {
        return $this->db
            ->select("COUNT(*) AS total")
            ->where("vaga.estabelecimento_id", $empresaId)
            ->where("vaga.statusVaga", 11)
            ->first()['total'];
    }
    
    public function listarVagas($filtros, $limite, $offset)
    {
        $descricao = isset($filtros['descricao']) ? trim(addslashes($filtros['descricao'])) : '';
        $cidade    = isset($filtros['cidade_id']) ? (int)$filtros['cidade_id'] : 0;
        $vinculo = isset($filtros['vinculo']) ? (int)$filtros['vinculo'] : 0;
        $modalidade = isset($filtros['modalidade']) ? (int)$filtros['modalidade'] : 0;
        $categoria = isset($filtros['categoria_vaga_id']) ? (int)$filtros['categoria_vaga_id'] : 0;
        $faixaSal = isset($filtros['faixaSal']) ? trim(addslashes($filtros['faixaSal'])) : '';
        $nivelExperiencia = isset($filtros['nivelExperiencia']) ? (int)$filtros['nivelExperiencia'] : 0;

        $query = $this->db->select("
                vaga.vaga_id,
                vaga.descricao,
                vaga.modalidade,
                vaga.dtInicio,
                vaga.dtFim,
                vaga.vinculo,
                vaga.faixaSal,
                vaga.nivelExperiencia, 
                c.cidade, 
                c.uf, 
                e.logo")
            ->join("cidade AS c", "c.cidade_id = vaga.cidade_id", "INNER")
            ->join("estabelecimento AS e", "e.estabelecimento_id = vaga.estabelecimento_id", "INNER")
            ->join("categoria_vaga AS cv", "vaga.categoria_vaga_id = cv.categoria_vaga_id", "LEFT")
            ->where("vaga.statusVaga", 11);

            if (!empty($descricao)) {
                $query->whereLike("vaga.descricao", $descricao);
            }

            if ($cidade > 0) {
                $query->where("vaga.cidade_id", $cidade);
            }

            if ($categoria > 0) {
                $query->where("cv.categoria_vaga_id", $categoria);
            }

            if ($vinculo > 0) {
                $query->where("vaga.vinculo", $vinculo);
            }

            if ($modalidade > 0) {
                $query->where("vaga.modalidade", $modalidade);
            }

            if ($nivelExperiencia > 0) {
                $query->where("vaga.nivelExperiencia", $nivelExperiencia);
            }

            if (!empty($faixaSal)) {
                switch ($faixaSal) {
                    case 'A combinar':
                        $query->whereRaw("LOWER(vaga.faixaSal) = 'a combinar'");
                        break;

                    case '1000-2000':
                        $query->whereRaw("vaga.faixaSal REGEXP '^[0-9]' AND CAST(vaga.faixaSal AS DECIMAL(10,2)) BETWEEN 1000 AND 2000");
                        break;

                    case '2000-4000':
                        $query->whereRaw("vaga.faixaSal REGEXP '^[0-9]' AND CAST(vaga.faixaSal AS DECIMAL(10,2)) BETWEEN 2000 AND 4000");
                        break;

                    case '4000-6000':
                        $query->whereRaw("vaga.faixaSal REGEXP '^[0-9]' AND CAST(vaga.faixaSal AS DECIMAL(10,2)) BETWEEN 4000 AND 6000");
                        break;

                    case '6000+':
                        $query->whereRaw("vaga.faixaSal REGEXP '^[0-9]' AND CAST(vaga.faixaSal AS DECIMAL(10,2)) >= 6000");
                        break;

                    default:
                        break;
                }
            }

            return $query
                ->orderBy("vaga.dtInicio", "DESC")
                ->limit($limite)
                ->offset($offset)
                ->findAll();
    }

    public function countVagas($filtros)
    {
        $descricao = isset($filtros['descricao']) ? trim(addslashes($filtros['descricao'])) : '';
        $cidade    = isset($filtros['cidade_id']) ? (int)$filtros['cidade_id'] : 0;
        $vinculo = isset($filtros['vinculo']) ? (int)$filtros['vinculo'] : 0;
        $modalidade = isset($filtros['modalidade']) ? (int)$filtros['modalidade'] : 0;
        $categoria = isset($filtros['categoria_vaga_id']) ? (int)$filtros['categoria_vaga_id'] : 0;
        $faixaSal = isset($filtros['faixaSal']) ? trim(addslashes($filtros['faixaSal'])) : '';
        $nivelExperiencia = isset($filtros['nivelExperiencia']) ? (int)$filtros['nivelExperiencia'] : 0;

        $query = $this->db->select("COUNT(DISTINCT vaga.vaga_id) AS total")
            ->join("cidade AS c", "c.cidade_id = vaga.cidade_id", "INNER")
            ->join("estabelecimento AS e", "e.estabelecimento_id = vaga.estabelecimento_id", "INNER")
            ->join("categoria_vaga AS cv", "vaga.categoria_vaga_id = cv.categoria_vaga_id", "LEFT")
            ->where("vaga.statusVaga", 11);

            if (!empty($descricao)) {
                $query->whereLike("vaga.descricao", $descricao);
            }

            if ($cidade > 0) {
                $query->where("vaga.cidade_id", $cidade);
            }

            if ($categoria > 0) {
                $query->where("cv.categoria_vaga_id", $categoria);
            }

            if ($vinculo > 0) {
                $query->where("vaga.vinculo", $vinculo);
            }

            if ($modalidade > 0) {
                $query->where("vaga.modalidade", $modalidade);
            }

            if ($nivelExperiencia > 0) {
                $query->where("vaga.nivelExperiencia", $nivelExperiencia);
            }

            if (!empty($faixaSal)) {
                switch ($faixaSal) {
                    case 'A combinar':
                        $query->whereRaw("LOWER(vaga.faixaSal) = 'a combinar'");
                        break;

                    case '1000-2000':
                        $query->whereRaw("vaga.faixaSal REGEXP '^[0-9]' AND CAST(vaga.faixaSal AS DECIMAL(10,2)) BETWEEN 1000 AND 2000");
                        break;

                    case '2000-4000':
                        $query->whereRaw("vaga.faixaSal REGEXP '^[0-9]' AND CAST(vaga.faixaSal AS DECIMAL(10,2)) BETWEEN 2000 AND 4000");
                        break;

                    case '4000-6000':
                        $query->whereRaw("vaga.faixaSal REGEXP '^[0-9]' AND CAST(vaga.faixaSal AS DECIMAL(10,2)) BETWEEN 4000 AND 6000");
                        break;

                    case '6000+':
                        $query->whereRaw("vaga.faixaSal REGEXP '^[0-9]' AND CAST(vaga.faixaSal AS DECIMAL(10,2)) >= 6000");
                        break;

                    default:
                        break;
                }
            }

            return $query
                ->first()['total'];
    }
}