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
}
