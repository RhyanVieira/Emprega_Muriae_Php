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
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaEstabelecimento()
    {   
        return $this->db->select()->findAll();
    }
}