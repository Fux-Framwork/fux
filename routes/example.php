<?php

use Fux\Http\FuxResponse;
use Fux\Http\Request;



\Fux\Routing\Routing::router()->get('/', function (Request $request) {
    return "Welcome in FuxFramework!";
});

\Fux\Routing\Routing::router()->get('/home', function (Request $request) {
    return \App\Controllers\TestController::myMethod($request);
});

\Fux\Routing\Routing::router()->get('/error', function () {
    return new FuxResponse("ERROR", "This is an error!", null, true);
});

\Fux\Routing\Routing::router()->get('/success', function () {
    return new FuxResponse("OK", "This is custom success page!", [
        "forwardLink" => "https://google.com",
        "forwardLinkText" => "Go to Google homepage"
    ], true);
});

\Fux\Routing\Routing::router()->withMiddleware(new \App\Middlewares\ExampleMiddleware(), function (){

    \Fux\Routing\Routing::router()->get('/middleware-protected-route', function (Request $request) {
        return "Welcome in (secured) FuxFramework!";
    });

});
