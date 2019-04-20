<?php namespace Haidara\Midlewares;

class ValidationErrorMidleware extends Midleware
{

  public function  __invoke($request, $response, $next)
  {
      $this->container->view->getEnvironment()->addGlobal('errors', isset($_SESSION['errors']) ? $_SESSION['errors'] : []);

      unset($_SESSION['errors']);

      $response = $next($request, $response);

      return $response;
  }
}

?>