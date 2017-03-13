<?php
namespace App\Backend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    public function initialize()
    {
        $this->view->bodyclass = "hold-transition skin-blue";
    }

}