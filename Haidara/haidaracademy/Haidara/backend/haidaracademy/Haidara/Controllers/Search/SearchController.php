<?php
/**
 * Created by PhpStorm.
 * User: haida
 * Date: 14/03/2018
 * Time: 00:54
 */

namespace Haidara\Controllers\Search;


use Haidara\Controllers\Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SearchController extends Controller
{

    public function searchFromDatabase(RequestInterface $request, ResponseInterface $response, $args){
       var_dump($args);
        die;
        return  $this->view->render($response,'search/search.twig',['q' =>$q]);
    }

}