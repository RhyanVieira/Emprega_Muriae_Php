<?php

namespace App\Model;

use Core\Library\ModelMain;

class CategoriaEstabelecimentoModel extends ModelMain
{
    protected $table = "categoria_estabelecimento";
    protected $primaryKey = "categoria_estabelecimento_id";
    
    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCategoriaEstabelecimento()
    {   
        return $this->db->select()->findAll();
    }
}