<?php

namespace App\Frontend\Controllers;

use App\Models\News;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class SalesController extends ControllerBase
{

    public function indexAction()
    {
        $currect_page = $this->request->get('page') ?? 1;

        $this->view->posts = (new PaginatorModel([
            'data' => News::find('category = 2'),
            'page' => $currect_page,
            'limit' => 12
        ]))->getPaginate();

        $this->tag->setTitle('Акции');
    }

}

