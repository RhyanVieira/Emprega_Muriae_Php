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


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaEstabelecimentos()
    {   
        return $this->db->select("
            e.estabelecimento_id,
            e.nome,
            e.descricao,
            e.logo,
            c.cidade,
            c.uf,
            e.data_criacao,
            COUNT(DISTINCT v.vaga_id) AS total_vagas,
            GROUP_CONCAT(DISTINCT ce.descricao ORDER BY ce.descricao SEPARATOR ', ') AS categorias
        FROM estabelecimento AS e
        INNER JOIN cidade AS c 
            ON c.cidade_id = e.cidade_id
        LEFT JOIN vaga AS v 
            ON v.estabelecimento_id = e.estabelecimento_id
        LEFT JOIN estabelecimento_categoria_estabelecimento AS ece 
            ON ece.estabelecimento_id = e.estabelecimento_id
        LEFT JOIN categoria_estabelecimento AS ce 
            ON ce.categoria_estabelecimento_id = ece.categoria_estabelecimento_id
        GROUP BY 
            e.estabelecimento_id, e.nome, e.descricao, e.logo, c.cidade, c.uf, e.data_criacao
        ORDER BY 
            CASE 
                WHEN COUNT(DISTINCT v.vaga_id) > 0 THEN 0  -- empresas com vagas primeiro
                ELSE 1                                    -- empresas sem vagas por último
            END,
            RAND();"
        )
        ->findAll();    
    }
}