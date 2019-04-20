<?php
namespace Haidara\Validation;

use Slim\Http\Request;
use Respect\Validation\Validator as   Respect;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Response;

class Validator{

    protected $errors;

    public function validate(Request $request, array $rules){

        foreach($rules as $field => $rule){

            try{
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e){

                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed(){
        //return  if the errors are not empty
        return !empty($this->errors);
    }
}