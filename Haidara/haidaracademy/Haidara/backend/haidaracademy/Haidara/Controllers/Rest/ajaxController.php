<?php namespace Haidara\Controllers;

use Haidara\Models\CategoryPost;
use Haidara\Models\Comment;
use Haidara\Models\Post;
use Haidara\Models\User;
use Psr\Http\Message\RequestInterface;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface;

class AjaxController extends Controller
{

    public function postAnswerOfComment(RequestInterface $request, ResponseInterface $response, $args)
    {

    }

    public function comment(RequestInterface $requestInterface, ResponseInterface $responseInterface, $ref_post)
    {

    }

}