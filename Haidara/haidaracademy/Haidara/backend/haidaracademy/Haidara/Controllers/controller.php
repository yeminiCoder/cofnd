<?php namespace Haidara\Controllers;

class Controller {


    protected  $navbar;

    protected $container;

    public function __construct($container)
    {

        $this->container = $container;
    }


    public function __get($property)
    {
        if($this->container{$property})
        {
            return $this->container->{$property};
        }

    }
}