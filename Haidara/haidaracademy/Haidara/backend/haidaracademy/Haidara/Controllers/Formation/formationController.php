<?php namespace Haidara\Controllers\Formation;

use Haidara\Controllers\Controller;
use Haidara\Models\Category;
use Haidara\Models\Cours;
use Haidara\Models\Post;
use Haidara\Models\Topic;
use Haidara\Models\User;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;
use Illuminate\Support\Facades\DB;

class FormationController extends Controller
{

    /**
     * @param $icategory
     * @param $response
     * @return mixed
     */
    private function render($icategory, $response, $args)
    {
      // if(User::isLogged())
      // {
     //   $ref = $args['ref'];
        $java = Cours::all();
        $phps = $java->where('CategoryID',$icategory)->all();
        $nav = explode('/',$_GET['url']);
        $_SESSION['nav'] = $nav[1] ;
        return  $this->view->render($response,'formation/category.twig',[ 'php' =>$phps, 'count'=>count($phps), 'nav' =>$nav[1]]);
      /* }
        else
        {
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }*/
    }


    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function getAll($request, $response)
    {
        return  $this->view->render($response,'haidara_files_backend/listFormation.html.twig',
            [
                'formations' =>Cours::allFormation(),
                "categories" =>Category::getAllCategories()
            ]);
    }

    /**
     * @param $request
     * @param $response
     */
    public function android($request , $response,$args)
    {
        $this->render(5,$response,$args);
    }

    /**
     * @param $request
     * @param $response
     */
    public function c($request , $response, $args)
    {
         $this->render(3,$response,$args);
    }

    /**
     * @param $request
     * @param $response
     */
    public function php($request , $response,$args)
    {
        $this->render(4,$response,$args);
    }

    /**
     * @param $request
     * @param $response
     */
    public function java($request, $response, $args)
     {
        $this->render(1,$response, $args);
     }

    /**
     * @param $request
     * @param $response
     */
    public function cplus($request , $response,$args)
    {
        $this->render(2,$response,$args);
    }

    /**
     * @param $request
     * @param $response
     */
    public function csh($request , $response,$args)
    {
      $this->render(6, $response, $args);
    }

    public function sgbd($request , $response)
    {

    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return static
     */
    public function getItemById(RequestInterface $request, ResponseInterface $response, $args)
    {
         $id = explode('-',$args['ref']);
         $ref = $id[0];
        if(!empty($ref))
        {
            if(v::intVal()->validate($ref))
            {
                $topics = Cours::find($ref);
                $nav = explode('/',$_GET['url']);
                return  $this->view->render($response,'formation/item.twig',['item' =>$topics, 'category'=>$nav[1], 'nav' =>$_SESSION['nav']]);
            }else
            {
                return $response->withStatus(404);
            }
        }
        return $response->withStatus(404);
    }
    public function getFormCourse(RequestInterface $request, ResponseInterface $response)
    {
       // if(User::isLogged())
        //{
            $categories = Category::all();
            return  $this->view->render($response,'haidara_files_backend/addCourse.html.twig',[
                'categories' => $categories
            ]);
       /* }else
        {
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }*/

    }
    public function saveNewFormation(RequestInterface $request, ResponseInterface $response)
    {
        if (User::isLogged()) {
            if (false === $request->getAttribute('csrf_status')) {
                // display suitable error here
                die('ooops');
            } else {
                // validate form data
                $validation = $this->validator->validate($request,
                    [
                        'name' => v::notEmpty(),
                        'content' => v::notEmpty(),
                        'cost' => v::notEmpty()->numeric(),
                        'type' => v::notEmpty(),
                        'category' => v::notEmpty()
                    ]);

                if ($validation->failed()) {
                    return $response->withRedirect($this->router->pathFor('new.formation'));
                } else {
                    /* getting data from form*/
                    $title = $request->getParam('name');
                    $content = $request->getParam('content');
                    $cost = $request->getParam('cost');
                    $category = $request->getParam('category');
                    $published = $request->getParam('published');
                    $idPrim = $request->getParam('type');

                    /** create a new course*/
                    Cours::create([
                        'Course_name' => $title,
                        'content' => $content,
                        'created_at' => new \DateTime(),
                        'updated_at' => new \DateTime(),
                        'cost' => $cost,
                        'slug' => base64_encode(rand(1, 1000)),
                        'categoryID' => $category,
                        'idPrim' => $idPrim,
                        'visibled' => $published,
                        'publisher' => 1//$_SESSION['userID']
                    ]);
                    return $response->withRedirect($this->router->pathFor('new.formation'));
                }
            }
        }else
        {
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }
    }
}