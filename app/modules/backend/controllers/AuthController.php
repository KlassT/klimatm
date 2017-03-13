<?php
namespace App\Backend\Controllers;

use App\Backend\Forms\LoginForm;
use App\Models\Admins;
use Phalcon\Mvc\View;

class AuthController extends ControllerBase
{

    public function loginAction()
    {
        if($this->session->has('adminAuth')) {
            $this->response->redirect('');
            return;
        }

        $this->view->disableLevel(
            [
                View::LEVEL_LAYOUT      => true,
                View::LEVEL_MAIN_LAYOUT => true,
            ]
        );

        $loginForm = new LoginForm();
        $this->view->loginForm = $loginForm;
        $this->view->bodyclass = 'hold-transition login-page';

        if($this->request->isPost())
        {
            $login = $this->request->getPost('login');
            $password = $this->request->getPost('password');

            if($loginForm->isValid($this->request->getPost())) {
                if($user = Admins::findFirst(['login = :login:', 'bind' => ['login' => $login]])) {
                    if($this->security->checkHash($password, $user->password)) {
                        $this->session->set('adminAuth', $user);
                        $this->response->redirect('');
                    }
                    else {
                        $this->flash->error('Неверный пароль');
                    }
                }
                else {
                    $this->flash->error('Данный пользователь неверный');
                }
            }
        }
    }

}