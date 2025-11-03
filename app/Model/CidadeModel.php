<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "cidade";
    
    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCidade()
    {   
        return $this->db->select()->findAll();
    }

}