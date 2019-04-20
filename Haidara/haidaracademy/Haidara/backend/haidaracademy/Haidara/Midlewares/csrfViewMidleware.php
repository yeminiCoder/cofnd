<?php namespace Haidara\Midlewares;

class CsrfViewMidleware extends Midleware
{
    public function  __invoke($request, $response, $next)
    {
        $keyPair = $this->container->csrf->generateToken();
        $this->container->view->getEnvironment()->addGlobal('csrf',
            [
                'field' => '
                <input type="hidden" name="' . $this->container->csrf->getTokenNameKey() . '" value="' . $keyPair['csrf_name'] . '">
                <input type="hidden" name="' . $this->container->csrf->getTokenValueKey() . '" value="' . $keyPair['csrf_value'] . '">
            ',
            ]

            );
        $response = $next($request, $response);
        return $response;
    }
}

?>