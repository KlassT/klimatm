<?php

namespace App\Frontend\Controllers;

use App\Models\Pages;

class PagesController extends ControllerBase
{

    public function indexAction($page)
    {
        $this->view->page = $page = Pages::findFirst(['uri = :uri:', 'bind' => ['uri' => $page]]);

        $this->tag->setTitle($page->title);
    }

}

