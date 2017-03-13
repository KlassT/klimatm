<?php

namespace App\Frontend\Controllers;

use App\Models\Cart;
use App\Models\Categories;
use App\Models\ProductsViews;
use App\Models\Slider;
use App\Models\Products;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class ProductsController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->slides = Slider::find(['order' => 'sort']);
        $this->view->saleProducts = Products::find(['sale_price IS NOT NULL', 'limit' => 4]);
    }

    public function searchAction()
    {
        $s = $this->request->get('s');
        $this->view->products = Products::find(['title LIKE :s:', 'bind' => ['s' => '%' . $s . '%']]);
        $this->tag->setTitle('Поиск: ' . $s);
    }

    public function categoryAction($category_uri)
    {
        $this->view->category = $category = Categories::findFirst(['uri = :uri:', 'bind' => ['uri' => $category_uri]]);
        $this->view->subCategories = $category->Subcategories;

        $this->tag->setTitle($category->category);

        $current_page = $this->request->get('page') ?? 1;

        $builder = $this->modelsManager->createBuilder()
            ->columns(['Products.id', 'Products.title', 'Products.price', 'Products.sale_price', 'Products.uri', 'Images.image'])
            ->from(['Products' => 'App\Models\Products'])
            ->leftJoin('App\Models\Images', 'Products.id = Images.product_id', 'Images');

        if($this->request->get('category')) {
            $cat = Categories::findFirst($this->request->get('category'));
            $builder = $builder->where('category_id = ' . $this->request->get('category'));
        }
        else {
            $cat = $category;
            $categories = [];
            foreach($category->Subcategories as $subcategory) {
                $categories[] = $subcategory->id;
            }
            $builder = $builder->inWhere('category_id', $categories);
        }

        /* BRANDS */
        $brands = [];
        if($cat->parent) {
            foreach($cat->Products as $product) {
                $brands[$product->Brand->id] = $product->Brand;
            }
        }
        else {
            foreach($cat->Subcategories as $subcategory) {
                foreach($subcategory->Products as $product) {
                    $brands[$product->Brand->id] = $product->Brand;
                }
            }
        }

        $this->view->brands = $brands;

        if($this->request->has('price_min')) {
            $builder = $builder->andWhere('Products.price >= ' . $this->request->get('price_min'));
        }
        if($this->request->has('price_max')) {
            $builder = $builder->andWhere('Products.price <= ' . $this->request->get('price_max'));
        }

        if($this->request->has('power_min') || $this->request->has('power_min')) {
            $builder = $builder->leftJoin('App\Models\ProductsAttributes', 'Products.id = ProductsAttributes.product_id', 'ProductsAttributes')
                ->leftJoin('App\Models\Attributes', 'Attributes.id = ProductsAttributes.attribute_id', 'Attributes')
                ->andWhere('Attributes.id = 63');
            if($this->request->has('power_min')) {
                $builder = $builder->andWhere('ProductsAttributes.value >= ' . $this->request->get('power_min'));
            }
            if($this->request->has('power_max')) {
                $builder = $builder->andWhere('ProductsAttributes.value <= ' . $this->request->get('power_max'));
            }
        }

        if($this->request->has('brands') && $this->request->get('brands') != '') {
            $brands = explode(',', $this->request->get('brands'));
            $builder = $builder->leftJoin('App\Models\Brands', 'Products.brand_id = Brands.id', 'Brands');
            $builder = $builder->inWhere('Brands.id', $brands);
        }

        $builder = $builder->getQuery()->execute();

        /* PRICE */
        $min = 99999999;
        $max = 0;
        if($cat->parent) {
            foreach($cat->Products as $product) {
                if(is_null($product->sale_price)) {
                    $price = $product->price;
                }
                else {
                    $price = $product->sale_price;
                }

                if($price < $min) $min = $price;
                if($price > $max) $max = $price;
            }
        }
        else {
            foreach($cat->Subcategories as $subcategory) {
                foreach($subcategory->Products as $product) {
                    if(is_null($product->sale_price)) {
                        $price = $product->price;
                    }
                    else {
                        $price = $product->sale_price;
                    }

                    if($price < $min) $min = $price;
                    if($price > $max) $max = $price;
                }
            }
        }
        $this->view->priceRange = ['min' => $min, 'max' => $max];

        /* МОЩНОСТЬ */
        if(($category->id == 14) || ($category->id == 15) || ($category->id == 16)) {
            $min = 99999999;
            $max = 0;
            if($cat->parent) {
                foreach($cat->Products as $product) {
                    foreach($product->Attributes as $attribute) {
                        if($attribute->Attribute->attribute == 'Мощность, кВт') {
                            if((float)join('.',explode(',',$attribute->value)) < $min) $min = (float)join('.',explode(',',$attribute->value));
                            if((float)join('.',explode(',',$attribute->value)) > $max) $max = (float)join('.',explode(',',$attribute->value));
                        }
                    }
                }
            }
            else {
                foreach($cat->Subcategories as $subcategory) {
                    foreach($subcategory->Products as $product) {
                        foreach($product->Attributes as $attribute) {
                            if($attribute->Attribute->attribute == 'Мощность, кВт') {
                                if((float)join('.',explode(',',$attribute->value)) < $min) $min = (float)join('.',explode(',',$attribute->value));
                                if((float)join('.',explode(',',$attribute->value)) > $max) $max = (float)join('.',explode(',',$attribute->value));
                            }
                        }
                    }
                }
            }
            $this->view->powerRange = ['min' => $min, 'max' => $max];
        }


        $this->view->products = (new PaginatorModel(
            [
                'data' => $builder,
                'page' => $current_page,
                'limit' => 30
            ]
        ))->getPaginate();
    }

    public function productAction($product_uri)
    {
        $this->view->product = $product = Products::findFirst(['uri = :product_uri:', 'bind' => ['product_uri' => $product_uri]]);
        $product->views = $product->views + 1;
        $product->save();

        $this->tag->setTitle('Поиск: ' . $product->title);

        $this->view->lastViews = ProductsViews::find(['product_id <> :product_id: AND user_id = :user_id:', 'bind' => ['product_id' => $product->id, 'user_id' => $this->session->get('auth')->id],'limit' => 4]);

        $last = ProductsViews::findFirst(['user_id = :user_id:', 'bind' => ['user_id' =>$this->session->get('auth')->id]]);
        if($last->product_id != $product->id) {
            $product_view = new ProductsViews();
            $product_view->user_id = $this->session->get('auth')->id;
            $product_view->product_id = $product->id;
            $product_view->save();
        }

    }

    public function addAction($product_id) {
        $count = $this->request->getPost('count');
        if(!$product_cart = Cart::findFirst(['product_id = :product_id: AND user_id = :user_id:', 'bind' => ['product_id' => $product_id, 'user_id' => $this->session->get('auth')->id]])) {
            $product_cart = new Cart();
            $product_cart->product_id = $product_id;
            $product_cart->user_id = $this->session->get('auth')->id;
            $product_cart->count = $count;
        }
        else {
            $product_cart->count += $count;
        }
        $product_cart->save();
        $this->flashSession->success('Товар успешно добавлен');
        $this->response->redirect('product/' . Products::findFirst($product_id)->uri);
    }

}

