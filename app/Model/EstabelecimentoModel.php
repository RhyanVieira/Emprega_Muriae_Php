<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "curriculum_escolaridade";
    
    public $validationRules = [
        "nome"  => [
            "label" => 'Nome do Estabelecimento ou Empresa',
            "rules" => 'required|min:3|max:60'
        ],
        "endereco"  => [
            "label" => 'Endereço',
            "rules" => 'min:30|max:200'
        ],
        "latitude"  => [
            "label" => 'Latitude',
            "rules" => 'required|min:12|max:12'
        ],
        "longitude"  => [
            "label" => 'Longitude',
            "rules" => 'required|min:12|max:12'
        ],
        "email"  => [
            "label" => 'E-mail',
            "rules" => 'min:12|max:150'
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
        "logo"  => [
            "label" => 'Logo',
            "rules" => 'max:255'
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