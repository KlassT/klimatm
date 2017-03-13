<?php
namespace App\Backend\Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;

class SecurityPlugin extends Plugin
{

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        if(!$this->session->has('adminAuth')) {
            if($dispatcher->getControllerName() != 'auth') {
                $dispatcher->forward([
                    'controller' => 'auth',
                    'action' => 'login'
                ]);
            }
        }
    }

}