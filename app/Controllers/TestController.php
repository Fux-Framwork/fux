<?php

namespace App\Controllers;

use Fux\Http\Request;

class TestController
{

    public static function myMethod(Request $request){
        $params = $request->getQueryStringParams();
        return view("myExampleView", ["myViewParameter" => "HelloWorld", "params" => $params]);
    }

}