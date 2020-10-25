<?php

use Firebase\JWT\JWT;

class  Users  extends Controller
{
    public  function index()
    {
        $headers = apache_request_headers();
        $token = explode(" ", $headers["Authorization"]);
        try {
            JWT::$leeway = 60*60; // $leeway in seconds
            $decoded = JWT::decode($token[1], SECRET_KEY, array('HS256'));
            echo json_encode($decoded->data);
        } catch ( Firebase\JWT\ExpiredException  $th) {
            simplerror($th->getMessage(),401);
        }
        catch (Exception $th ){
            simplerror($th->getMessage(),500);
        }
    }
}
