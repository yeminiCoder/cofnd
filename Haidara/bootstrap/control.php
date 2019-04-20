<?php
use Respect\Validation\Validator as v;

/**
 * Controllers injection in the containers here
 */

// Register provider
$container['flash'] = function ($container) {
  return new \Slim\Flash\Messages();
};

$container['auth'] = function($container){
  return new \Haidara\Auth\Auth;
};

$container['view'] = function ($container) {
  $view = new \Slim\Views\Twig(__DIR__ . '/../ressources/views',
         [
          'cache' => false
        ]);
  $view->addExtension(new Slim\Views\TwigExtension(
          $container->router,
          $container->request->getUri()

      ));


  $view->getEnvironment()->addGlobal('auth',
      [
          'check' =>$container->auth->check(),
          'user'  =>$container->auth->user()
      ]
      );


      $view->getEnvironment()->addGlobal('flash', $container);

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

$container['ChangePassword'] = function($container){
  return new \Haidara\Controllers\Auth\ChangePasswordController($container);
};

$container['ConfirmationCompte'] = function($container){
  return new \Haidara\Controllers\Auth\ConfirmationCompteController($container);
};

$container['Setting'] = function($container){
  return new \Haidara\Controllers\Auth\SettingController($container);
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

$container['CommentController'] = function($container){
  return new \Haidara\Controllers\Comment\CommentController($container);
};
$container['TransactionController'] = function($container){
  return new \Haidara\Controllers\Transaction\TransactionController($container);
};
$container['Tutorial'] = function($container){
  return new \Haidara\Controllers\Tutorial\TutorialController($container);
};
$container['Ajax'] = function($container){
  return new \Haidara\Controllers\Ajax\AjaxController($container);
};
$container['ErrorController'] = function($container){
  return new \Haidara\Controllers\Error\ErrorController($container);
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
$app->add(new \Haidara\Midlewares\CsrfViewMidleware($container));
