<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Validator;

class EstabelecimentoModel extends ModelMain
{
    protected $table = "estabelecimento";
    
    public $validationRules = [
        "nome"  => [
            "label" => 'Nome do Estabelecimento ou Empresa',
            "rules" => 'required|min:3|max:60'
        ],
        "endereco"  => [
            "label" => 'Endereço',
            "rules" => 'max:200'
        ],
        "latitude"  => [
            "label" => 'Latitude',
            "rules" => 'required|min:11|max:12'
        ],
        "longitude"  => [
            "label" => 'Longitude',
            "rules" => 'required|min:11|max:12'
        ],
        "email"  => [
            "label" => 'E-mail',
            "rules" => 'max:150'
        ],
        "cnpj"  => [
            "label" => 'CNPJ',
            "rules" => 'required|min:18|max:18'
        ],
        "razao_social"  => [
            "label" => 'Razão Social',
            "rules" => 'required|min:3|max:255'
        ],
        "website"  => [
            "label" => 'Web Site',
            "rules" => 'max:255'
        ],
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'max:1000'
        ],
        "cep"  => [
            "label" => 'CEP',
            "rules" => 'required|min:8|max:8'
        ],
        "cidade_id"  => [
            "label" => 'Cidade',
            "rules" => 'required|int'
        ],
    ];

    public function listaEstabelecimentos($filtros, $limite, $offset)
    {
        $nome      = isset($filtros['nome']) ? trim(addslashes($filtros['nome'])) : '';
        $cidade    = isset($filtros['cidade_id']) ? (int)$filtros['cidade_id'] : 0;
        $categoria = isset($filtros['categoria_id']) ? (int)$filtros['categoria_id'] : 0;

        $query = $this->db->select("
            estabelecimento.estabelecimento_id,
            estabelecimento.nome,
            estabelecimento.descricao,
            estabelecimento.logo,
            c.cidade,
            c.uf,
            estabelecimento.data_criacao,
            COUNT(DISTINCT v.vaga_id) AS total_vagas,
            GROUP_CONCAT(DISTINCT ce.descricao ORDER BY ce.descricao SEPARATOR ', ') AS categorias
        ")
        ->join("cidade AS c", "c.cidade_id = estabelecimento.cidade_id", "INNER")
        ->join("vaga AS v", "v.estabelecimento_id = estabelecimento.estabelecimento_id", "LEFT")
        ->join("estabelecimento_categoria_estabelecimento AS ece", "ece.estabelecimento_id = estabelecimento.estabelecimento_id", "LEFT")
        ->join("categoria_estabelecimento AS ce", "ce.categoria_estabelecimento_id = ece.categoria_estabelecimento_id", "LEFT");

        if (!empty($nome)) {
            $query->whereLike("estabelecimento.nome", $nome);
        }

        if ($cidade > 0) {
            $query->where("estabelecimento.cidade_id", $cidade);
        }

        if ($categoria > 0) {
            $query->where("ce.categoria_estabelecimento_id", $categoria);
        }

        return $query
            ->groupBy("estabelecimento.estabelecimento_id, estabelecimento.nome, estabelecimento.descricao, estabelecimento.logo, c.cidade, c.uf, estabelecimento.data_criacao")
            ->orderBy("
                CASE 
                    WHEN COUNT(DISTINCT v.vaga_id) > 0 THEN 0
                    ELSE 1
                END
            ")
            ->orderBy("RAND()")
            ->limit($limite)
            ->offset($offset)
            ->findAll();
    }


    public function countEstabelecimentos($filtros)
    {
        $nome      = isset($filtros['nome']) ? trim(addslashes($filtros['nome'])) : '';
        $cidade    = isset($filtros['cidade_id']) ? (int)$filtros['cidade_id'] : 0;
        $categoria = isset($filtros['categoria_id']) ? (int)$filtros['categoria_id'] : 0;

        $query = $this->db
            ->select("COUNT(DISTINCT estabelecimento.estabelecimento_id) AS total")
            ->join("cidade AS c", "c.cidade_id = estabelecimento.cidade_id", "INNER")
            ->join("estabelecimento_categoria_estabelecimento AS ece", "ece.estabelecimento_id = estabelecimento.estabelecimento_id", "LEFT")
            ->join("categoria_estabelecimento AS ce", "ce.categoria_estabelecimento_id = ece.categoria_estabelecimento_id", "LEFT");

        if (!empty($nome)) {
            $query->whereLike("estabelecimento.nome", $nome);
        }

        if (!empty($cidade)) {
            $query->where("estabelecimento.cidade_id", $cidade);
        }

        if (!empty($categoria)) {
            $query->whereRaw("e.estabelecimento_id IN (
                SELECT estabelecimento_id 
                FROM estabelecimento_categoria_estabelecimento 
                WHERE categoria_estabelecimento_id = $categoria
            )");
        }

        return $query
            ->first()['total'];
    }

    public function getInfoCompleta($id)
    {
        return $this->db
            ->select("
                estabelecimento.estabelecimento_id,
                estabelecimento.nome,
                estabelecimento.razao_social,
                estabelecimento.email,
                estabelecimento.website,
                estabelecimento.logo,
                estabelecimento.endereco,
                estabelecimento.descricao,
                estabelecimento.cnpj,
                estabelecimento.cep,
                estabelecimento.data_criacao,
                estabelecimento.latitude,
                estabelecimento.longitude,
                c.cidade,
                c.uf,
                GROUP_CONCAT(DISTINCT ce.descricao ORDER BY ce.descricao SEPARATOR ', ') AS categorias,
                COUNT(DISTINCT v.vaga_id) AS total_vagas
            ")
            ->join("cidade AS c", "c.cidade_id = estabelecimento.cidade_id", "LEFT")
            ->join("estabelecimento_categoria_estabelecimento AS ece", "ece.estabelecimento_id = estabelecimento.estabelecimento_id", "LEFT")
            ->join("categoria_estabelecimento AS ce", "ce.categoria_estabelecimento_id = ece.categoria_estabelecimento_id", "LEFT")
            ->join("vaga AS v", "v.estabelecimento_id = estabelecimento.estabelecimento_id", "LEFT")
            ->where("estabelecimento.estabelecimento_id", $id)
            ->groupBy("
                estabelecimento.estabelecimento_id, 
                estabelecimento.nome, 
                estabelecimento.razao_social, 
                estabelecimento.email, 
                estabelecimento.website, 
                estabelecimento.logo, 
                estabelecimento.endereco, 
                estabelecimento.descricao, 
                estabelecimento.cnpj, 
                estabelecimento.cep, 
                estabelecimento.data_criacao, 
                c.cidade, 
                c.uf
            ")
            ->first();
    }
}