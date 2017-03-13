<?php

namespace App\Frontend\Controllers;

use App\Models\Slider;
use App\Models\Products;
use App\Models\News;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->setTitle('Главная');

        $this->view->slides = Slider::find(['order' => 'sort']);
        $this->view->news = News::find(['category = 1', 'order' => 'created_at DESC', 'limit' => 3]);
        $this->view->sales = News::find(['category = 2', 'order' => 'created_at DESC', 'limit' => 3]);
        $this->view->saleProducts = Products::find(['sale_price IS NOT NULL', 'limit' => 4]);
        $this->view->newProducts = Products::find(['order' => 'created_at DESC', 'limit' => 4]);
    }

}