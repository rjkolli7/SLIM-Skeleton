<?php

namespace AndroidIM\Controllers\Auth;

use AndroidIM\Models\User;
use AndroidIM\Controllers\Controller;
use Respect\Validation\Validator as v;


class PasswordController extends Controller
{
    public function getChangePassword($request, $response){

        return $this->view->render($response, 'auth/password/change.twig');

    }

    public function postChangePassword($request, $response){

        $validation = $this->validator->validate($request, [
            'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password'      =>  v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()){
            $this->flash->addMessage('error','Something failed, your password was not changed!');
            return $response->withRedirect($this->router->pathFor('auth.password.change'));
        }

        $this->auth->user()->setPassword($request->getParam('password'));

        $this->flash->addMessage('info','Your password was changed!');
        return $response->withRedirect($this->router->pathFor('home'));
    }
}
