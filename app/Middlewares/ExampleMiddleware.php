<?php

namespace App\Middlewares;


use Fux\Http\Middleware\FuxMiddleware;
use Fux\Http\FuxResponse;

class ExampleMiddleware extends FuxMiddleware
{

    public function handle()
    {
        $canPassMiddleware = true;
        if (!$canPassMiddleware) {
            return new FuxResponse("ERROR", "You cannot view this page");
        }

        return $this->resolve();
    }

}
