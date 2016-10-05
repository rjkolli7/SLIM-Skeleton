<?php

use Respect\Validation\Validator as v;

session_start();

require __DIR__ . '/../vendor/autoload.php';



$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' =>[
            'driver' => 'mysql',
            'host'  =>  'api.datahub.at',
            'database'  => 'androidIM',
            'username' => 'androidIM',
            'password'  =>  'gAa&01s0',
            'charset'   =>  'utf8',
            'collation' =>  'utf8_unicode_ci',
            'prefix'    =>  '',

        ]
    ],

]);


$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$container['db'] = function ($container) use ($capsule){
    return $capsule;
};



$container['view'] = function ($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views' , [
       'cache' => false,
    ]);


    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getURI()
    ));

    return $view;
};

$container['validator'] = function ($container){
    return new AndroidIM\Validation\Validator;
};

$container['HomeController'] = function ($container){
    return new \AndroidIM\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container){
    return new \AndroidIM\Controllers\Auth\AuthController($container);
};

$app->add(new \AndroidIM\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \AndroidIM\Middleware\OldInputMiddleware($container));


v::with('AndroidIM\\Validation\\Rules\\');



require __DIR__ .'/../app/routes.php';