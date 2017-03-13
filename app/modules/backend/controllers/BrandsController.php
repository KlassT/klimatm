<?php
namespace App\Backend\Controllers;

use App\Backend\Forms\BrandForm;
use App\Models\Brands;
use Behat\Transliterator\Transliterator;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class BrandsController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->brands = Brands::find();
        $this->view->form = new BrandForm();
    }

    public function addAction()
    {
        $this->view->disable();

        if($this->request->isPost()) {
            $form = new BrandForm();
            if($form->isValid($this->request->getPost())) {
                $brand = new Brands();
                $brand->brand = $this->request->getPost('brand');

                if(!$brand->save()) {
                    foreach($brand->getMessages() as $message) {
                        $this->flashSession->error($message->getMessage());
                    }
                }
                else {
                    $this->flashSession->success('Производитель успешно добавлен');
                }
            }
            else {
                foreach($form->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            }
        }
        $this->response->redirect('brands');
    }

    public function editAction($id)
    {
        $this->view->brand = $brand = Brands::findFirst($id);
        $this->view->form = $form = new BrandForm($brand);

        if($this->request->isPost()) {
            if($form->isValid($this->request->getPost())) {
                $brand->brand = $this->request->getPost('brand');

                if(!$brand->save()) {
                    foreach($brand->getMessages() as $message) {
                        $this->flashSession->error($message->getMessage());
                    }
                }
                else {
                    $this->flash->success('Производитель успешно изменен');
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
            foreach(explode(',', $this->request->getPost('items')) as $brand_id) {
                $brandId = (int)$brand_id;
                $brand = Brands::findFirst($brandId);
                if(!$brand->delete()) {
                    foreach($brand->getMessages() as $message) {
                        echo $message->getMessage();
                    }
                }
            }
            $this->flashSession->success('Успешно удалено');
        }
        else {
            $this->flashSession->error('Вы ничего не выбрали');
        }
        $this->response->redirect('brands');
    }

}