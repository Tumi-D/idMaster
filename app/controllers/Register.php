<?php

Class  Register  extends Controller
{
    public function __construct()
    {
        $data = invalidRoute();
        echo json_encode($data);   
        die;
    }
    
}
