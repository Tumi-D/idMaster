<?php

class  Register  extends PostController
{
    /**
    * All post and put/patch/delete requests should go through here;
    */

    public function __construct(){
         $exceptions =['phone',"otp"];
         exclude($exceptions);
         
    }
     public function index(){
        extract($_POST);
        $rules =[
            "phonenumber" =>"required|numeric|min:10",
            "password" => "required|min:8"
        ];
        validate($rules,"json");
    }

    public function phone()
    {
        extract($_POST);
        $rules =[
            "phonenumber" =>"required|numeric|min:10",
        ];
        validate($rules,"json");
        $users = new UserModel();
        dd($users);
    }
}
