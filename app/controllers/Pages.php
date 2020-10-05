<?php

class Pages extends Controller
{

   public function index()
   {
      $data = [
        "About" => [
            "Application" => "IDMeister Api",
            "Authur" => "Chris Debrah",
            "Version" => "1.0.0"
         ],
         "Api" => [
            "Login" => [
               "method" => "POST",
               "route" => URLROOT . "login",
               "parameters" => [
                  "phonenumber" => "Required Field | mininimum 10 characters",
                  "password" => "Required Field | mininimum 6 characters"
               ]
            ],
            "Register" => [
                  "method" => "POST",
                  "steps" => [
                     1 => [
                        "route" => URLROOT . "register/phone",
                        "parameters" => [
                           "phonenumber" => "Required Field | mininimum 10 characters",
                        ]
                     ],
                     2 => [
                        "route" => URLROOT . "register/otp",
                        "parameters" => [
                           "otp" => "Required Field | mininimum 6 characters",
                        ]
                     ],
                     3 => [
                        "route" => URLROOT . "register/complete",
                        "parameters" => [
                           "password" => "Required Field | mininimum 6 characters",
                        ]
                     ]
                  ]
               ]
          ],
         "license" => [
            "name" => "MIT",
            "Link" => "https://opensource.org/licenses/MIT"
         ]
      ];
      echo json_encode($data);
   }
}
