<?php
namespace App\Backend\Controllers;


use App\Models\Products;
use App\Models\Users;
use App\Models\Cart;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->countProducts = Products::count();
        $this->view->countUsers = Users::count();
        $this->view->countOrders = 322;
        $this->view->countInCart = Cart::count();
    }

}