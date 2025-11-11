<?php

namespace App\Model;

use Core\Library\ModelMain;

class CategoriaVagaModel extends ModelMain
{
    protected $table = "categoria_vaga";
    
    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaTotalVagas()
    {   
        return $this->db
        ->select("categoria_vaga.categoria_vaga_id, categoria_vaga.descricao, categoria_vaga.icone, COUNT(vaga.vaga_id) AS total_vagas")
        ->join("vaga", "vaga.categoria_vaga_id = categoria_vaga.categoria_vaga_id")
        ->groupBy("categoria_vaga.categoria_vaga_id, categoria_vaga.descricao, categoria_vaga.icone")
        ->where("statusVaga", 11)
        ->orderBy("total_vagas", "DESC")
        ->limit(8)
        ->findAll();
    }

}