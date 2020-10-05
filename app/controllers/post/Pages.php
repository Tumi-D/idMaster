<?php
class Pages extends PostController
{

    

    public function __contruct()
    {
        $data = invalidRoute();
        echo json_encode($data);   
        die;
    }
}
