<?php

class  Login  extends PostController
{
    /**
    * All post and put/patch/delete requests should go through here;
    */
     public function index(){
       extract($_POST);
       $rules =[
           "phonenumber" =>"required|numeric|min:10",
           "password" => "required|min:8"
       ];
       validate($rules,"json");
       $jwt =generateAPIToken();
       echo json_encode($jwt);
    }
}
