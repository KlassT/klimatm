<?php
namespace App\Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Textarea;

class NewsForm extends Form
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

        $category = new Hidden('category', [
            'value' => $options['category']
        ]);
        $this->add($category);
    }

}