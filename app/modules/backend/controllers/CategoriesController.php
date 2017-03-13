<?php
namespace App\Backend\Controllers;

use App\Backend\Forms\CategoryForm;
use Phalcon\Security\Random;
use App\Models\Categories;
use Behat\Transliterator\Transliterator;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class CategoriesController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->categories = Categories::find(['parent IS NULL', 'order' => 'category']);
        $this->view->form = new CategoryForm();
    }

    public function addAction()
    {
        $this->view->disable();

        if($this->request->isPost()) {
            $form = new CategoryForm();
            if($form->isValid($this->request->getPost())) {
                $category = new Categories();
                $category->category = $this->request->getPost('category');
                if($this->request->getPost('parent') != "")
                    $category->parent = $this->request->getPost('parent');
                $category->uri = Transliterator::transliterate($this->request->getPost('category'));

                if($this->request->hasFiles()) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        if($file->getName() != '') {
                            $name = (new Random())->uuid() . '.' . $file->getExtension();
                            $category->image = $name;
                            if($file->moveTo('files/categories/' . $name)) {
                                $category->save();
                            }
                        }
                    }
                }

                if(!$category->save()) {
                    foreach($category->getMessages() as $message) {
                        $this->flashSession->error($message->getMessage());
                    }
                }
                else {
                    $this->flashSession->success('Категория успешно добавлена');
                }
            }
            else {
                foreach($form->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            }
        }
        $this->response->redirect('categories');
    }

    public function editAction($id)
    {
        $this->view->category = $category = Categories::findFirst($id);
        $this->view->form = $form = new CategoryForm($category);

        if($this->request->isPost()) {
            if($form->isValid($this->request->getPost())) {
                $category->category = $this->request->getPost('category');
                if($this->request->getPost('parent') != "")
                    $category->parent = $this->request->getPost('parent');
                $category->uri = Transliterator::transliterate($this->request->getPost('category'));

                if($this->request->hasFiles()) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        if($file->getName() != '') {
                            $name = (new Random())->uuid() . '.' . $file->getExtension();
                            $category->image = $name;
                            if($file->moveTo('files/categories/' . $name)) {
                                $category->save();
                            }
                        }
                    }
                }

                if(!$category->save()) {
                    foreach($category->getMessages() as $message) {
                        $this->flashSession->error($message->getMessage());
                    }
                }
                else {
                    $this->flash->success('Категория успешно изменена');
                }
            }
            else {
                foreach($form->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            }
        }
    }

    public function deleteAction()
    {
        if($this->request->getPost('items') != '') {
            foreach(explode(',', $this->request->getPost('items')) as $category_id) {
                $categoryId = (int)$category_id;
                $category = Categories::findFirst($categoryId);
                if(!$category->delete()) {
                    foreach($category->getMessages() as $message) {
                        echo $message->getMessage();
                    }
                }
            }
            $this->flashSession->success('Успешно удалено');
        }
        else {
            $this->flashSession->error('Вы ничего не выбрали');
        }
        $this->response->redirect('categories');
    }

}