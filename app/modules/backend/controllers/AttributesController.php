<?php
namespace App\Backend\Controllers;

use App\Backend\Forms\AttributeForm;
use App\Models\Attributes;

class AttributesController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->attributes = Attributes::find();
        $this->view->form = new AttributeForm();
    }

    public function addAction()
    {
        $this->view->disable();

        if($this->request->isPost()) {
            $form = new AttributeForm();
            if($form->isValid($this->request->getPost())) {
                $attribute = new Attributes();
                $attribute->attribute = $this->request->getPost('attribute');

                if(!$attribute->save()) {
                    foreach($attribute->getMessages() as $message) {
                        $this->flashSession->error($message->getMessage());
                    }
                }
                else {
                    $this->flashSession->success('Атрибут успешно добавлен');
                }
            }
            else {
                foreach($form->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            }
        }
        $this->response->redirect('attributes');
    }

    public function editAction($id)
    {
        $this->view->attribute = $attribute = Attributes::findFirst($id);
        $this->view->form = $form = new AttributeForm($attribute);

        if($this->request->isPost()) {
            if($form->isValid($this->request->getPost())) {
                $attribute->attribute = $this->request->getPost('attribute');

                if(!$attribute->save()) {
                    foreach($attribute->getMessages() as $message) {
                        $this->flashSession->error($message->getMessage());
                    }
                }
                else {
                    $this->flash->success('Атрибут успешно изменен');
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
            foreach(explode(',', $this->request->getPost('items')) as $attribute_id) {
                $attributeId = (int)$attribute_id;
                $attribute = Attributes::findFirst($attributeId);
                if(!$attribute->delete()) {
                    foreach($attribute->getMessages() as $message) {
                        echo $message->getMessage();
                    }
                }
            }
            $this->flashSession->success('Успешно удалено');
        }
        else {
            $this->flashSession->error('Вы ничего не выбрали');
        }
        $this->response->redirect('attributes');
    }

}