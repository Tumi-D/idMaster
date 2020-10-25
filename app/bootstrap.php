<?php

// Including the configuration file
require_once 'config/config.php';
require_once 'config/config_env.php';
require_once 'helpers/general_helper.php';
require_once 'helpers/email.php';
require_once 'helpers/validation.php';


// Load everything we require via composer
require('../vendor/autoload.php');



// or render to string
// $html = $latte->renderToString('template.latte', $parameters);

/*
 * Autoload Core Libraries
 *
 * Note: We are not using namespaces, so this will
 * blow up in our faces if we have any duplicate class
 * names! TODO: consider using namespaces!
 */

spl_autoload_register(function ($class) {

    $pathContorllers = APPROOT . '/controllers/' . $class . '.php';
    $pathLibs = APPROOT . '/libraries/' . $class . '.php';
    $pathModels = APPROOT . '/models/' . $class . '.php';
    $pathServices = APPROOT . '/service/' . $class . '.php';
    $factoriesServices = APPROOT . '/models/factories/' . $class . '.php';
    $Traits = APPROOT . '/traits/' . $class . '.php';


    if (file_exists($pathContorllers)) {
        require_once $pathContorllers;
    } elseif (file_exists($pathLibs)) {
        require_once $pathLibs;
    } elseif (file_exists($pathModels)) {
        require_once $pathModels;
    } elseif (file_exists($pathServices)) {
        require_once $pathServices;
    } elseif (file_exists($factoriesServices)) {
        require_once $factoriesServices;
    }
});

/**
 * We are always going to need the database, so we are going to
 * create our database object here. It can then be referenced
 * in class member functions as "global $connectedDb"
 */

$connectedDb = new Database();
//$client = new Google_Client();

// provide a catch all exception handler...
/**
 * @param $exception
 */
function pokemon($exception)
{
    // $errordata = [
    //     'exceptiondata' => $exception,
    //     'errormessage' => $exception->getMessage()
    // ];
    // dd($exception);

    // $errordisplaycontroller = new Controller();
    // $errordisplaycontroller->view("pages/errorpage", $errordata);
    $errorinfo = array(
        'error' => [
            "message"=> $exception->getMessage(),
            "line" => "The exception was created on line: " . $exception->getLine(),
            "file" => $exception->getFile()
        ],
        'code' => 500,
        "software"=> COMPANYNAME
    );
    http_response_code(500);
    header('Content-Type,application/json');
    echo json_encode($errorinfo);
    die;
    exit();
}

// Gotta catch 'em all!
set_exception_handler('pokemon');

// use Illuminate\Database\Capsule\Manager as Capsule;
// require_once __DIR__ . '\src\Register\eloquence.php';
// require "vendor/autoload.php";
// We also always need the session object, and need to create it before any output.
session_start();
