<?php
namespace App\Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;

class LoginForm extends Form
{

    public function initialize($entity = null, $options = [])
    {
        $login = new Text('login', [
            'placeholder' => 'Логин',
            'class' => 'form-control'
        ]);
        $this->add($login);

        $password = new Password('password', [
            'placeholder' => 'Пароль',
            'class' => 'form-control'
        ]);
        $this->add($password);
    }

}