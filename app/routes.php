<?php

use AndroidIM\Middleware\AuthMiddleware;
use AndroidIM\Middleware\GuestMiddleware;

$app->get('/','HomeController:index')->setName('home');


$app->group('', function (){
    $this->get('/auth/signin','AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin','AuthController:postSignIn');
    $this->get('/auth/signup','AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup','AuthController:postSignUp');
})->add(new GuestMiddleware($container));



$app->group('', function(){
    $this->get('/auth/signout','AuthController:getSignOut')->setName('auth.signout');
    $this->get('/auth/password/change','PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change','PasswordController:postChangePassword');
})->add(new AuthMiddleware($container));






