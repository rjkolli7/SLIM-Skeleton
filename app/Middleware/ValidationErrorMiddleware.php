<?php

namespace AndroidIM\Middleware;

class ValidationErrorsMiddleware extends Middleware {

    public function __invoke($request,$response,$next)
    {
     var_dump('Middleware');
    }

}