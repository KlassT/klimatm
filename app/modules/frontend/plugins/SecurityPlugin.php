<?php
namespace App\Frontend\Plugins;

use Carbon\Carbon;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Security\Random;
use App\Models\Users;

class SecurityPlugin extends Plugin
{

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        if(!$this->session->has('auth')) {
            if(!$this->cookies->has('auth')) {
                $user = Users::findFirst([
                    'remote_addr = :remote_addr:',
                    'bind' => [
                        'remote_addr' => $this->request->getServerAddress()
                    ]
                ]);
                if(!$user) {
                    $user = new Users();
                    $user->remote_addr = $this->request->getServerAddress();
                    $user->created_at = (string)Carbon::now();
                    $user->token = (new Random())->uuid();
                    if(!$user->save()) {
                        foreach($user->getMessages() as $message) {
                            echo $message->getMessage();
                        }
                    }
                }
                $this->cookies->set('auth', $user->token, Carbon::now()->addYear());
            }
            else {
                $user = Users::findFirst([
                    'token = :token:',
                    'bind' => [
                        'token' => $this->cookies->get('auth')
                    ]
                ]);
            }

            $this->session->set('auth', $user);
        }
    }

}