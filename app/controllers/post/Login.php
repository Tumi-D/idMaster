<?php

 /**
    * All post and put/patch/delete requests should go through here;
  */
class  Login  extends PostController
{
  public function index()
  {
    extract($_POST);
    $rules = [
      "phonenumber" => "required|numeric|min:10",
      "password" => "required|min:8"
    ];
    validate($rules, "json");
    $user = UserModel::where('phone', '=', $phonenumber)->first();
    if ($user && password_verify($password, $user->password)) {
      $validuser = [
        "id" => $user->id,
        "firstname" => $user->firstname,
        "lastname" => $user->lastname,
      ];
      $jwt = generateAPIToken($validuser);
      $data = [
        "data" => [
          "token" => $jwt,
          "user" =>[
            "firstname" =>$user->firstname,
            "lastname" => $user->lastname,
            "phone" => $user->phone
          ]
        ],
      ];
      echo json_encode($data);
    } else {
      simplerror("Login Failed",401);
      echo json_encode($error);
    }
  }
}
