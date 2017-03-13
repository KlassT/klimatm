<?php
namespace App\Backend\Controllers;

use App\Backend\Forms\ProductForm;
use App\Models\Images;
use App\Models\Products;
use App\Models\ProductsAttributes;
use App\Models\ProductsCategories;
use App\Models\SaleProducts;
use Behat\Transliterator\Transliterator;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Security\Random;

class ProductsController extends ControllerBase
{

    public function indexAction()
    {
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $this->view->products = (new PaginatorModel(
            [
                "data"  => Products::find(['order' => 'created_at DESC']),
                "limit" => 25,
                "page"  => $currentPage,
            ]
        ))->getPaginate();
    }

    public function addAction()
    {
        $form = new ProductForm();
        $this->view->productForm = $form;

        if($this->request->isPost()) {
            if($form->isValid($this->request->getPost())) {
                $product = new Products();
                $product->category_id = $this->request->getPost('category_id');
                $product->title = $this->request->getPost('title');
                $product->description = $this->request->getPost('description');
                $product->price = $this->request->getPost('price');
                $product->sale_price = $this->request->getPost('sale_price');
                $product->uri = Transliterator::transliterate($this->request->getPost('title'));

                if(!$product->save()) {
                    foreach($product->getMessages() as $message) {
                        $this->flash->error($message->getMessage());
                    }
                }
                else {
                    foreach($this->request->getPost('attribute') as $attribute_id => $value) {
                        $product_attribute = new ProductsAttributes();
                        $product_attribute->product_id = $product->id;
                        $product_attribute->attribute_id = $attribute_id;
                        $product_attribute->value = $value;
                        $product_attribute->save();
                    }

                    if($this->request->hasFiles()) {
                        foreach ($this->request->getUploadedFiles() as $file) {
                            if($file->getName() != '') {
                                $name = (new Random())->uuid() . '.' . $file->getExtension();
                                if(!$image = Images::findFirst(['product_id = :product:', 'bind' => ['product' => $product->id]])) {
                                    $image = new Images();
                                    $image->product_id = $product->id;
                                }
                                $image->image = $name;
                                if($file->moveTo('files/products/' . $name)) {
                                    $image->save();
                                }
                            }
                        }
                    }

                    $this->flashSession->success('Товар успешно добавлен');
                    $this->response->redirect('products');
                }
            }
            else {
                foreach($form->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            }
        }
    }

    public function editAction($id)
    {
        $product = Products::findFirst($id);
        $form = new ProductForm($product);
        $this->view->productForm = $form;
        $this->view->product = $product;

        if($this->request->isPost()) {
            if($form->isValid($this->request->getPost())) {
                $product->category_id = $this->request->getPost('category_id');
                $product->title = $this->request->getPost('title');
                $product->description = $this->request->getPost('description');
                $product->price = $this->request->getPost('price');
                $product->sale_price = $this->request->getPost('sale_price');
                $product->uri = Transliterator::transliterate($this->request->getPost('title'));

                if($this->request->hasFiles()) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        if($file->getName() != '') {
                            $name = (new Random())->uuid() . '.' . $file->getExtension();
                            if(!$image = Images::findFirst(['product_id = :product:', 'bind' => ['product' => $product->id]])) {
                                $image = new Images();
                                $image->product_id = $product->id;
                            }
                            $image->image = $name;
                            if($file->moveTo('files/products/' . $name)) {
                                $image->save();
                            }
                        }
                    }
                }

                if(!$product->save()) {
                    foreach($product->getMessages() as $message) {
                        $this->flash->error($message->getMessage());
                    }
                }
                else {
                    ProductsAttributes::find(['product_id = :product:', 'bind' => ['product' => $product->id]])->delete();
                    if($this->request->hasPost('attribute'))
                    foreach($this->request->getPost('attribute') as $attribute_id => $value) {
                        $product_attribute = new ProductsAttributes();
                        $product_attribute->product_id = $product->id;
                        $product_attribute->attribute_id = $attribute_id;
                        $product_attribute->value = $value;
                        $product_attribute->save();
                    }
                    $this->flash->success('Товар успешно изменен');
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
            foreach(explode(',', $this->request->getPost('items')) as $product_id) {
                $productId = (int)$product_id;
                $product = Products::findFirst($productId);
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
        $this->response->redirect('products');
    }

}