<?php

namespace App\Model;

use Core\Library\ModelMain;

class CargoModel extends ModelMain
{
    protected $table = "cargo";
    
    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCargo()
    {   
        return $this->db->select()->findAll();
    }

}