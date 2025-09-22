<?php

namespace App\Model;

use Core\Library\ModelMain;

class UsuarioModel extends ModelMain
{
    protected $table = "usuario";

    public $validationRules = [
        "nome_usuario"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:60'
        ],
        "email"  => [
            "label" => 'Email',
            "rules" => 'required|min:5|max:150'
        ],
        "senha" => [
            "label" => "Senha",
            "rules" => "required|min:8|max:100"
        ],
        "nivel"  => [
            "label" => 'Nível',
            "rules" => 'required|int'
        ],
        "statusRegistro"  => [
            "label" => 'Status',
            "rules" => 'required|int'
        ],
        "termo_uso"  => [
            "label" => 'Termos de Uso',
            "rules" => 'required|int'
        ],
        "politica_privacidade"  => [
            "label" => 'Política de Privacidade',
            "rules" => 'required|int'
        ]
    ];

    /**
     * getUserEmail
     *
     * @param string $email 
     * @return array
     */
    public function getUserEmail($email)
    {
        return $this->db->where("email", $email)->first();
    }
}