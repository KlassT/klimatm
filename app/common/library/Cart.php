<?php
namespace App;

use Phalcon\Mvc\User\Component;
use App\Models\Cart as CartModel;

class Cart extends Component
{

    private $_user = null;

    public function __construct()
    {
        $this->_user = $this->user->getUser();
    }

    public function total()
    {
        $products = $this->getProducts();

        $sum = 0;
        if($products) {
            foreach ($products as $product) {
                if($product->Product->sale_price) {
                    $sum += $product->Product->sale_price * $product->count;
                }
                else {
                    $sum += $product->Product->price * $product->count;
                }
            }
        }

        echo $sum;
    }

    public function getProducts()
    {
        return CartModel::find(['user_id = :user_id:', 'bind' => ['user_id' => $this->_user->id]]);
    }

}