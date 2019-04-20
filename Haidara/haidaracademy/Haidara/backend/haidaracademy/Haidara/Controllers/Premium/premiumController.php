<?php namespace Haidara\Controllers\Premium;

use Haidara\Controllers\Controller;


class PremiumController extends Controller
{

    public function getAll($request, $response)
    {
        return  $this->view->render($response,'premium/premium.twig');
    }

}