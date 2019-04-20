<?php namespace Haidara\Controllers;

  use Haidara\Models\Comment;
  use Haidara\Models\Post;
  use Psr\Http\Message\RequestInterface;
  use Respect\Validation\Validator as v;
  use Psr\Http\Message\ResponseInterface;

  class HomeController extends Controller
  {
      public function index($request, $response)
      {
         return  $this->view->render($response,'haidara_files_backend/dashboard.html.twig',
             ['navbar' =>'isOk' ,'posts'=>Post::all()]);
      }
      public function findOne(RequestInterface $request, ResponseInterface $response, $args)
      {
          $id = explode('-', $args['ref']);
          $ref = $id[0];
          if(!empty($ref))
          {
              if(v::intVal()->validate($ref))
              {
                  $one = Post::findOne($ref);
                  return  $this->view->render($response,'haidara_files_backend/onePost.twig',['one' =>$one]);
              }else
              {
                  return $response->withStatus(404);
              }
          }
      }


      public function add(RequestInterface $request, ResponseInterface $response)
      {

      }

  }