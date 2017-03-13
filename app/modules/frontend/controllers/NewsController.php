<?php

namespace App\Frontend\Controllers;

use App\Models\News;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class NewsController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->setTitle('Новости');

        $currect_page = $this->request->get('page') ?? 1;

        $this->view->posts = (new PaginatorModel([
            'data' => News::find('category = 1'),
            'page' => $currect_page,
            'limit' => 12
        ]))->getPaginate();
    }

}

