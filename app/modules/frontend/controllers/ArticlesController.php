<?php

namespace App\Frontend\Controllers;

use App\Models\Slider;
use App\Models\Products;
use App\Models\News;

class ArticlesController extends ControllerBase
{

    public function newsAction($post_uri)
    {
        $this->view->post = $post = News::findFirst(['uri = :uri:', 'bind' => ['uri' => $post_uri]]);

        $this->tag->setTitle($post->title);
    }

}

