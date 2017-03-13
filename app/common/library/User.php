<?php
namespace App;

use Phalcon\Mvc\User\Component;

class User extends Component
{

    private $_user;

    public function __construct()
    {
        $this->_user = $this->session->get('auth');
    }

    public function getUser()
    {
        return $this->_user;
    }

}