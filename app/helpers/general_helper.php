<?php

//use PHPMailer\PHPMailer\PHPMailer;
use \Firebase\JWT\JWT;


function generateApikey()
{
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    } else {
        mt_srand((float) microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = chr(123)
            . substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12)
            . chr(125);
        $guid = $uuid;
        $str = array("{", "}");
        return str_replace($str, "", $guid);
    }
}

function privilege($accountype)
{
    if ($accountype == 'Merchant') {
        $access = 100;
    }
    if ($accountype == 'Super Agent') {
        $access = 110;
    }
    return $access;
}


function randomToken($length = 5)
{
    if (!isset($length) || intval($length) <= 8) {
        $length = 32;
    }
    if (function_exists('random_bytes')) {
        return bin2hex(random_bytes($length));
    }
    if (function_exists('openssl_random_pseudo_bytes')) {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}

function invalidRoute($method="POST",$reference=URLROOT)
{
    if($method =="GET" || $method == "POST"){
        $message = "Use {$method} Route Instead";
    }
    else{
        $message = "Route 404";
    }
     $data = [
            "error" =>[
                "message"=>"Invalid Route",
            ],
            "hint" =>[
                "message" =>  $message,
                "reference" => $reference
            ]
       ];
       return $data;
}

function except($urls){


}

function generateAPIToken($data){
    
$key = SECRET_KEY;
$iat = time(); // time of token issued at
$nbf = $iat + 10; //not before in seconds
$exp = $iat + 60; // expire time of token in seconds
$payload = array(
    "iss" => URLROOT,
    "aud" => URLROOT,
    "iat" =>  $iat,
    "nbf" => $nbf,
    "exp" => $exp,
        // "data" => array(
        //     "id" => 11,
        //     "email" => "chrisdebbrah@gmail.com"
        // )
 "data" =>    $data
    );
/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::encode($payload, $key);
// JWT::$leeway = 60; // $leeway in seconds
// $decoded = JWT::decode($jwt, $key, array('HS256'));
// dd($decoded);

return $jwt;
}




function generateOtp()
{

    $value = 0;

    if (function_exists('mt_rand')) {
        do {
            $value = mt_rand(100000, 999999);
        } while ($value ==  OTPModel::checkOtp($value));
        return $value;
    }
    if (function_exists('rand')) {
        do {
            $value = rand(100000, 999999);
        } while ($value ==  OTPModel::checkOtp($value));
        return $value;
    }
    if (function_exists('random_int')) {
        do {
            $value = random_int(100000, 999999);
        } while ($value ==  OTPModel::checkOtp($value));
        return $value;
    }
}
function exclude($exceptions)
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
    else
    $link = "http";
    $link .= "://";
    $link .= $_SERVER['HTTP_HOST'];
    $link .= $_SERVER['REQUEST_URI'];
    // $results  = str_replace(URLROOT, "",  $link);
    $pos = strrpos($link, '/');
    $results = $pos === false ? $link : substr($link, $pos + 1);
    if (in_array($results, $exceptions)) {
        return true;
    } else {
        $data = invalidRoute("NO");
        echo json_encode($data);
        die;
    }
}
function testinput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function Salt()
{
    return substr(strtr(base64_encode(hex2bin(randomToken(5))), '+', '.'), 0, 44);
}
