<?php
namespace App\Backend\Forms;

use App\Models\Categories;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Select;

class AttributeForm extends Form
{

    public function initialize($entity = null, $options = [])
    {
        $attribute = new Text('attribute', [
            'placeholder' => 'Название',
            'class' => 'form-control'
        ]);
        $attribute->setLabel('Название');
        $this->add($attribute);
    }

}