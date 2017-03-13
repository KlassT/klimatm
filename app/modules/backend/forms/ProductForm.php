<?php
namespace App\Backend\Forms;

use App\Models\Attributes;
use App\Models\Categories;
use App\Models\Brands;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Textarea;
use Phalcon\Forms\Element\Password;

class ProductForm extends Form
{

    public function initialize($entity = null, $options = [])
    {
        $title = new Text('title', [
            'placeholder' => 'Название',
            'class' => 'form-control'
        ]);
        $title->setLabel('Название');
        $this->add($title);

        $description = new Textarea('description', [
            'placeholder' => 'Описание',
            'class' => 'form-control'
        ]);
        $description->setLabel('Описание');
        $this->add($description);

        $category = new Select('category_id', Categories::find() , [
            'using' => ['id', 'category'],
            'useEmpty' => true,
            'class' => 'form-control select2'
        ]);
        $category->setLabel('Категория');
        $this->add($category);

        $brand = new Select('brand_id', Brands::find() , [
            'using' => ['id', 'brand'],
            'useEmpty' => true,
            'class' => 'form-control select2'
        ]);
        $brand->setLabel('Производитель');
        $this->add($brand);

        $price = new Text('price', [
            'class' => 'form-control'
        ]);
        $price->setLabel('Цена');
        $this->add($price);

        $attributes = new Select('attributes', Attributes::find(['order' => 'attribute']), [
            'using' => ['id', 'attribute'],
            'class' => 'select2 form-control',
        ]);
        $attributes->setLabel('Добавить атрибут');
        $this->add($attributes);

        $sale_price = new Text('sale_price', [
            'class' => 'form-control'
        ]);
        $sale_price->setLabel('Цена на распродаже');
        $this->add($sale_price);
    }

}