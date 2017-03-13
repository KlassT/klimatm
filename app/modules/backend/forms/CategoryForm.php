<?php
namespace App\Backend\Forms;

use App\Models\Categories;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Select;

class CategoryForm extends Form
{

    public function initialize($entity = null, $options = [])
    {
        $category = new Text('category', [
            'placeholder' => 'Название',
            'class' => 'form-control'
        ]);
        $category->setLabel('Название');
        $this->add($category);

        $parent = new Select('parent', Categories::find(), [
            'using' => ['id', 'category'],
            'useEmpty' => true,
            'placeholder' => 'Пароль',
            'class' => 'form-control select2'
        ]);
        $parent->setLabel('Родительская категория');
        $this->add($parent);

        $parent = new File('image', [
            'class' => 'form-control'
        ]);
        $parent->setLabel('Изображение');
        $this->add($parent);
    }

}