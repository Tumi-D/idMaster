<?php

Class  Login  extends Controller
{
    public  function index(){
     $data = invalidRoute();
     echo json_encode($data);
     die;
    }
    
}
