<?php namespace Haidara\Midlewares;

class Midleware
{
    protected  $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

}
?>