<?php

namespace App\Frontend\Controllers;

use App\Models\Cart;

class CartController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->cart = Cart::findByUser($this->user->getUser());
        $this->tag->setTitle('Корзина');
    }

    public function deleteAction($id)
    {
        Cart::findFirst($id)->delete();
        $this->flashSession->success('Товар успешно удалён');
        $this->response->redirect('cart');
    }

}

