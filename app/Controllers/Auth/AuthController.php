<?php

namespace AndroidIM\Controllers\Auth;

use AndroidIM\Models\User;
use AndroidIM\Controllers\Controller;


class AuthController extends Controller
{
    public function getSignUp($request,$response){

        return $this->view->render($response, 'auth/signup.twig');

    }

    public function postSignUp($request,$response){

        $user = User::create([
            'email' =>  $request->getParam('email'),
            'name' =>  $request->getParam('name'),
            'password' =>  password_hash($request->getParam('password'),PASSWORD_DEFAULT),
        ]);

        return $response->withRedirect($this->router->pathFor('home'));

    }



}
