<?php
/**
 * Controller.php created by
 * User: Dominik Pirngruber
 * Date: 04.10.2016
 * Time: 20:37
 */

namespace AndroidIM\Controllers;

class Controller
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if($this->container->{$property}){
            return $this->container->{$property};
        }
    }
}