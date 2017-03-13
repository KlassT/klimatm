<?php
namespace App\Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Textarea;

class PageForm extends Form
{

    public function initialize($entity = null, $options = [])
    {
        $title = new Text('title', [
            'placeholder' => 'Название',
            'class' => 'form-control'
        ]);
        $title->setLabel('Название');
        $this->add($title);

        $content = new Textarea('content', [
            'placeholder' => 'Содержимое',
            'class' => 'form-control'
        ]);
        $content->setLabel('Содержимое');
        $this->add($content);
    }

}