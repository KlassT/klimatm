<?php
namespace App\Backend\Forms;

use App\Models\Categories;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Select;

class BrandForm extends Form
{

    public function initialize($entity = null, $options = [])
    {
        $category = new Text('brand', [
            'placeholder' => 'Название',
            'class' => 'form-control'
        ]);
        $category->setLabel('Название');
        $this->add($category);
    }

}