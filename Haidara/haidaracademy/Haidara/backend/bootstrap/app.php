<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';
use Respect\Validation\Validator as v;
$app = new \Slim\App(
    [
      'settings' =>[

          'determineRouteBeforeAppMiddleware' => true,
          'displayErrorDetails'=>true,
          'addContentLengthHeader' => false,

            'db'=>[
                  'driver'    =>'mysql',
                  'host'      =>'localhost',
                  'database'  =>'corfriend',
                  'username'  =>'root',
                  'password'  =>'',
                  'charset'   =>'utf8',
                  'collation' =>'utf8_unicode_ci',
                  'prefix'    =>''
                  ]
         ],

]);

// Get container
$container = $app->getContainer();

$capsule= new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function () use($capsule) { return $capsule; };

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../ressources/views',
           [
            'cache' => false
          ]);
    $view->addExtension(new Slim\Views\TwigExtension(
            $container->router,
            $container->request->getUri()

        ));
    return $view;
};

$container['validator'] = function($container){
    return new \Haidara\Validation\Validator;
};

$container['HomeController'] = function($container){
    return new \Haidara\Controllers\HomeController($container);
};

$container['Auth'] = function($container){
    return new \Haidara\Controllers\Auth\AuthController($container);
};


$container['auth'] = function($container){
    return new \Haidara\Auth\Auth();
};


$container['Formation'] = function($container){
    return new \Haidara\Controllers\Formation\FormationController($container);
};

$container['Premium'] = function($container){
    return new \Haidara\Controllers\Premium\PremiumController($container);
};

$container['SearchController'] = function($container){
    return new \Haidara\Controllers\Search\SearchController($container);
};
$container['Tutorial'] = function($container){
    return new \Haidara\Controllers\Tutorial\TutorialController($container);
};
$container['csrf'] = function($container){
    $guard = new \Slim\Csrf\Guard();
    $guard->setPersistentTokenMode(true);
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", true);
        return $next($request, $response);
    });
    return $guard;
};

//injection de dependance csrf
$app->add($container->csrf);

v::with('Haidara\\Validation\\Rules\\');

//Midleware
$app->add(new \Haidara\Midlewares\ValidationErrorMidleware($container));
$app->add(new \Haidara\Midlewares\OldInputMidleware($container));
// routes
 require_once __DIR__ . '/../haidaracademy/routes.php';
?>