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
    if (password_verify($password, $user->password) && $user) {
      $validuser = [
        "id" => $user->id,
        "firstname" => $user->firstname,
        "lastname" => $user->lastname,
        "phone" => $user->phone
      ];
      $jwt = generateAPIToken($validuser);
      $data = [
        "data" => [
          "token" => $jwt,
          "user" =>$validuser
        ],
      ];
      echo json_encode($data);
    } else {
      $error = [
        "error" => [
          "message" => "Login Failed"
        ],
        "software" => COMPANYNAME
      ];
      echo json_encode($error);
    }
  }
}
