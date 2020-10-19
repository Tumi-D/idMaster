<?php

use Carbon\Carbon;

class  Register  extends PostController
{
    public function __construct()
    {
        $exceptions = ['phone', "verifyotp", "password", "resendotp"];
        exclude($exceptions);
    }
    public function phone()
    {
        extract($_POST);
        $rules = [
            "phonenumber" => "required|numeric|min:10|unique:users",
            "country" => "required",
        ];
        validate($rules, "json");
        $user = UserModel::create(["phone" => $phonenumber, "country" => $country]);
        $this->sendOtp($user->id, $phonenumber);
    }
    private function sendOtp($user_id, $phonenumber)
    {
        $results = generateOtp($user_id);
        $message = "Welcome to IDMEISTER your OTP is {$results["pin"]}";
        if ($results["status"]) {
            $header = [
                "Content-Type:application/json",
                "Authorization: Basic " . SMSTOKEN
            ];
            $formparams = [
                "from" => COMPANYNAME,
                "to" => $phonenumber,
                "msg" => $message
            ];
            $results = performRequest('POST', 'send', $formparams, $header);
            $results = json_decode($results);
            if ($results->status) {
                $data = [
                    "status" => true,
                    "message" => "OTP sent to number",
                    "hint" => [
                        "method" => "POST",
                        "link" => URLROOT . "register/verifyotp",
                        "params" => [
                            "otp" => "required,minimum 6"
                        ]
                    ]
                ];
                echo json_encode($data);
            } else {
                simplerror("OTP was not sent to phonenumber check number and try again");
            }
        } else {
            $error = [
                "status" => false,
                "message" => "OTP  was not sent to phone",
                "hint" => [
                    "method" => "POST",
                    "link" => URLROOT . "register/resendotp",
                    "params" => [
                        "otp" => "required,minimum 6"
                    ]
                ]
            ];
            echo json_encode($error);
        }
    }
    public  function verifyotp()
    {
        extract($_POST);
        $rules = [
            "otp" => "required|numeric|min:6"
        ];
        validate($rules, "json");
        $otp = OTPModel::getOTP($otp);
        if (empty($otp) || $otp == false) {
            simplerror('Invalid Otp', 404);
        }
        $currenttime = Carbon::now();
        $expirytime = $otp->expires_at;
        $difference = $currenttime->diffInHours($expirytime);
        if (!$otp->confirmed && $difference < 2) {
            $otp = new OTPModel($otp->id);
            $otpcol = $otp->recordObject;
            $otpcol->confirmed = true;
            $otp->store();
            OTPModel::deleteUnConfirmedIds($otp->recordObject->user_id);
            $data = [
                "status" => true,
                "message" => "OTP verified successfully",
                "hint" => [
                    "method" => "POST",
                    "link" => URLROOT . "register/password",
                    "params" => [
                        "otp" => "required,minimum 6",
                        "password" => "required,minimum 8"
                    ]
                ]
            ];
            echo json_encode($data);
        } else {
            simplerror('Expired Otp', 400);
        }
    }
    public  function password()
    {
        extract($_POST);
        $rules = [
            'otp' => "required|min:6",
            'password' => "required|min:8"
        ];
        validate($rules, 'json');
        $otp =  OTPModel::getVerifiedOTP($otp);
        if (!empty($otp)) {
            $user = UserModel::find($otp->user_id);
            if (empty($user->password)) {
                $user->password = password_hash($password, PASSWORD_BCRYPT);;;
                $user->save();
                $data = [
                    "status" => true,
                    "message" => "Congratulations registeration complete",
                    "hint" => [
                        "method" => "POST",
                        "link" => URLROOT . "register/resendotp",
                        "params" => [
                            "otp" => "required,minimum 6"
                        ]
                    ]
                ];
                echo json_encode($data);
            } else {
                simplerror('Please reset password invalid operation',422);
            }
        } else {
            $data = [
                "status" => false,
                "message" => "Registeration failed",
                "hint" => [
                    "method" => "POST",
                    "link" => URLROOT . "register/resendotp",
                    "params" => [
                        "otp" => "required,minimum 6"
                    ]
                ]
            ];
        }
    }
    public function resendotp()
    {
        extract($_POST);
        $rules = [
            "phonenumber" => "required|numeric|min:10",
        ];
        validate($rules, "json");
        try {
            $user  = UserModel::where("phone", $phonenumber)->first();
            if ($user) {
                null !== $user->password  ? simplerror("Please proceed to reset password your registeration is complete.", 422) : $this->sendOtp($user->id, $phonenumber); 
            } else {
                simplerror("Account does not exist", 404);
            }
        } catch (\Throwable $th) {
            simplerror($th->getMessage(), 500);
        }
    }
}
