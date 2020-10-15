<?php

use Firebase\JWT\JWT;
use PhpParser\Node\Stmt\TryCatch;

class  Users  extends Controller
{
    public  function index()
    {
        $headers = apache_request_headers();
        $token = explode(" ", $headers["Authorization"]);
        try {
            JWT::$leeway = 60; // $leeway in seconds
            $decoded = JWT::decode($token[1], SECRET_KEY, array('HS256'));
            dd($decoded);
        } catch ( Firebase\JWT\ExpiredException  $th) {
            // dd($th->getMessage());
            simplerror($th->getMessage());
        }
       
    //    dd($decoded);


    }
}
