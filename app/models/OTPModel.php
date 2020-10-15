<?php


class OTPModel extends tableDataObject
{
  
    const TABLENAME = 'OTP';

    public static function checkOtp($value)
    {
        global $connectedDb;
        $query = "SELECT `pin`  FROM  otp WHERE otp.`pin` = $value";
        $connectedDb->prepare($query);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }
    public static function getOTP($value)
    {
        global $connectedDb;
        $query = "SELECT *  FROM  otp WHERE otp.`pin` = $value AND otp.`confirmed` = 0";
        $connectedDb->prepare($query);
        $connectedDb->execute();
        return $connectedDb->singleRecord();
    }
    public static function getVerifiedOTP($value)
    {
        global $connectedDb;
        $query = "SELECT *  FROM  otp WHERE otp.`pin` = $value AND otp.`confirmed` = 1";
        $connectedDb->prepare($query);
        $connectedDb->execute();
        return $connectedDb->singleRecord();
    }

    public static function deleteUnConfirmedIds($user_id)
    {
        global $connectedDb;
        $query = "DELETE FROM otp WHERE otp.`user_id` = $user_id AND otp.`confirmed` = 0";
        $connectedDb->prepare($query);
        return  $connectedDb->execute();
    }

    
}
