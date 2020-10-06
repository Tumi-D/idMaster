<?php

use Faker\Factory;

/***
 * For more info on faker variables check faker tutorial at http://zetcode.com/php/faker   
 * or check this  github page https://github.com/fzaninotto/Faker for source code 
 */
class  UsersFactory
{
   private static $number = 5;
   public function __contruct($number)
   {
      self::$number = $number;
   }

   public static function run()
   {
      $factory = Factory::create();
      for ($i = 0; $i < self::$number; $i++) {
         $users = new UserModel();
         $users->firstname =  $factory->firstName();
         $users->lastname =  $factory->lastName;
         $users->phone =  $factory->phoneNumber;
         $users->password = password_hash('password', PASSWORD_BCRYPT);;
         // $users->country = 0;
         $users->save();
      }
   }
}
