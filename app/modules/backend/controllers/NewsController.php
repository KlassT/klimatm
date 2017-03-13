<?php
namespace App\Backend\Controllers;

use App\Models\News;
use App\Backend\Forms\NewsForm;
use Behat\Transliterator\Transliterator;
use Phalcon\Security\Random;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class NewsController extends ControllerBase
{

    public function indexAction()
    {
        $current_page = $this->request->get('page') ?? 1;

        $this->view->news = $news = (new PaginatorModel([
            'data' => News::find(['category = 1', 'order' => 'created_at DESC']),
            'page' => $current_page,
            'limit' => 30
        ]))->getPaginate();
    }

    public function addAction()
    {
        $this->view->form = $form = new NewsForm(null, ['category' => 1]);

        if($this->request->isPost()) {
            if(!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            }
            else {
                $post = new News();
                $post->category = 1;
                $post->title = $this->request->getPost('title');
                $post->description = $this->request->getPost('description');
                $post->uri = Transliterator::transliterate($this->request->getPost('title'));

                if($this->request->hasFiles()) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        if($file->getName() != '') {
                            $name = (new Random())->uuid() . '.' . $file->getExtension();
                            $file->moveTo('files/news/' . $name);
                            $post->image = $name;
                        }
                    }
                }
                if(!$post->save()) {
                    foreach ($post->getMessages() as $message) {
                        $this->flash->error($message->getMessage());
                    }
                }
                else {
                    $this->flashSession->success('Новость создана');
                    $this->response->redirect('news');
                }
            }
        }
    }

    public function editAction($id)
    {
        $this->view->post = $post = News::findFirst($id);
        $this->view->form = $form = new NewsForm($post, ['category' => 1]);

        if($this->request->isPost()) {
            if(!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            }
            else {
                $post->category = 1;
                $post->title = $this->request->getPost('title');
                $post->description = $this->request->getPost('description');
                $post->uri = Transliterator::transliterate($this->request->getPost('title'));

                if($this->request->hasFiles()) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        if($file->getName() != '') {
                            $name = (new Random())->uuid() . '.' . $file->getExtension();
                            $file->moveTo('files/news/' . $name);
                            $post->image = $name;
                        }
                    }
                }
                if(!$post->save()) {
                    foreach ($post->getMessages() as $message) {
                        $this->flash->error($message->getMessage());
                    }
                }
                else {
                    $this->flash->success('Новость изменена');
                }
            }
        }
    }

    public function deleteAction()
    {
        if($this->request->getPost('items') != '') {
            foreach(explode(',', $this->request->getPost('items')) as $product_id) {
                $productId = (int)$product_id;
                $product = News::findFirst($productId);
                if(!$product->delete()) {
                    foreach($product->getMessages() as $message) {
                        echo $message->getMessage();
                    }
                }
            }
            $this->flashSession->success('Успешно удалено');
        }
        else {
            $this->flashSession->error('Вы ничего не выбрали');
        }
        $this->response->redirect('news');
    }

}