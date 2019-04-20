<?php namespace Haidara\Controllers\Auth;

use Haidara\Controllers\Controller;
use Haidara\Models\User;
use Haidara\Validation\Validator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController extends Controller
{

    public function getLogin($request, $response)
    {

        return $this->view->render($response, 'haidara_files_backend/login.html.twig');
    }

    public function postLogin(RequestInterface $request, ResponseInterface $response)
    {
        if (false === $request->getAttribute('csrf_status')) {
            // display suitable error here
            die('ooops');
        } else {
            $validation = $this->validator->validate($request,
                [
                    'email' => v::noWhitespace()->notEmpty(),
                    'password' => v::notEmpty()
                ]);
            if ($validation->failed()) {

                $login = $request->getParam('email');
                $password = $request->getParam('password');
                $auth = $this->container->auth->atempt($login, $password);
                if ($auth) {
                    $_SESSION['user'] = $auth->id;
                    return $response->withRedirect($this->router->pathFor('home'));
                } else {
                    return $response->withRedirect($this->router->pathFor('auth.login'));
                }
            }
        }
        return $response->withRedirect($this->router->pathFor('auth.login'));

    }

    public function getRegister(RequestInterface $request, ResponseInterface $response)
    {
        if($this->islogged()){
            return $response->withRedirect($this->router->pathFor('home'));
        }else
        {
            return $this->view->render($response, 'haidara_files_backend/register.html.twig');
        }
    }
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function getForget(RequestInterface $request, ResponseInterface $response)
    {
        return $this->view->render($response, 'haidara_files_backend/forgot-password.html.twig');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return static
     */
    public function postRegister(Request $request, Response $response)
    {

        $validation= $this->validator->validate($request,
            [
                'email'    =>  v::noWhitespace()->notEmpty()->emailAvailable(),
                'username' =>   v::notEmpty()->alpha(),
                 'password'   =>v::notEmpty()
            ]);

        if($validation->failed())
        {
           return $response->withRedirect($this->router->pathFor('auth.register'));
        }

        $user=User::create([
            'username'=>$request->getParam('username'),
            'password'=>password_hash($request->getParam('password'),PASSWORD_BCRYPT),
            'email'=>$request->getParam('email'),
        ]);

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getListModo(Request $request, Response $response){
        return $this->view->render($response, 'haidara_files_backend/modo.html.twig',['modos' =>User::findModo()]);
    }
    public function getListMembers(Request $request, Response $response){
        return $this->view->render($response, 'haidara_files_backend/listMember.html.twig',['members' =>User::findAllMember()]);
    }
}