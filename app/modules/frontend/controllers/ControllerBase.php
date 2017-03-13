<?php
namespace App\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    public function initialize()
    {
        $this->tag->appendTitle(' | Климмат Market');
    }

}
