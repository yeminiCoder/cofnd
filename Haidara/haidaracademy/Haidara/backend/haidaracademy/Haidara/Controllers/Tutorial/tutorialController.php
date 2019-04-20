<?php namespace Haidara\Controllers\Tutorial;

use Haidara\Controllers\Controller;
use Haidara\Models\CategoryPost;
use Haidara\Models\Post;
use Haidara\Models\User;
use Illuminate\Support\Facades\App;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;


class TutorialController extends Controller
{
    public function getAll($request, $response)
    {

        return $this->view->render($response, 'tutorial/tutorial.twig',
            ['item' => 1, "tutorials" => Post::all()]);
    }

    public function getForm(RequestInterface $request, ResponseInterface $response)
    {
        if (User::isLogged()) {
            $categories = CategoryPost::all();
            return $this->view->render($response, 'haidara_files_backend/add.html.twig', [
                'categories' => $categories
            ]);
        } else {
            return $response->withRedirect($this->router->pathFor('auth.login'));

        }
    }

    public function show_all_tutorial(RequestInterface $requestInterface, ResponseInterface $responseInterface)
    {

        return $this->view->render($responseInterface, 'haidara_files_backend/a_tuto.html.twig', [
            'posts' => Post::allTuto()
        ]);
    }

    public function save(RequestInterface $requestInterface, ResponseInterface $responseInterface)
    { 
       if(v::notEmpty()->validate($_POST)){
        $title = $requestInterface->getParam('title');
        $description = $requestInterface->getParam('description');
        $type = $requestInterface->getParam('type');
        $category = $requestInterface->getParam('category');    
               Post::create([
                   'Title' => $title,
                   'Description' => $description,
                   'date_created_at' => new \DateTime(),
                   'type' => $type,
                   'slogan' => uniqid(),
                   'category' => $category,
                   'status' => 1
               ]);
           }
       
        $_SESSION["message"] = "insertion a reussi!";
        return $responseInterface->withRedirect($this->router->pathFor('new.post'));
    }
    public function watch(RequestInterface $request, ResponseInterface $response, $args)
    {
        $categID = $args['id'];
        $item = $args['month'];
        if (!empty($categID) && !empty($item)) {
            if (v::intVal()->validate($categID) && v::intVal()->validate($item)) {
                $this->view->render($response, 'tutorial/watch.twig', ['id' => $categID, 'tuto' => CategoryPost::find($categID)]);
            } else {
                return $response->withStatus(404);
            }
        } else {
            return $response->withStatus(404);
        }

    }

    public function  hash($field)
    {
        return base64_encode($field);
    }

}