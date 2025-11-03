<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;

class Categoria extends ControllerMain
{
    protected $files;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->files = new Files();
    }

}