<?php

namespace App\Backend\Controllers;

use App\Backend\Forms\PageForm;
use App\Models\Pages;

class PagesController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->pages = Pages::find();
    }

    public function editAction($id) {
        $this->view->page = $page = Pages::findFirst($id);
        $this->view->form = $form = new PageForm($page);

        if($this->request->isPost()) {
            $page->title = $this->request->getPost('title');
            $page->content = $this->request->getPost('content');
            $page->save();
            $this->flash->success('Страница успешно изменена');
        }
    }

}

