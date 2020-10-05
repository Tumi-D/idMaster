<?php

use Faker\Factory;

/***
 * For more info on faker variables check faker tutorial at http://zetcode.com/php/faker   
 * or check this  github page https://github.com/fzaninotto/Faker for source code 
 */
class  CountryFactory
{
   private static $number = 10;
   public function __contruct($number)
   {
      self::$number = $number;
   }
 
   public static function run()
   {
      // $factory = Factory::create();
      // for ($i = 0; $i < self::$number; $i++) {

      //    $country = new CountryModel();
      //    // $countrycol = &$country->recordObject;
      //    // $countrycol->firstname = $factory->firstName();
      //    //Add the other record objects
      //    // $country->store();
      // }\
      $roles = [
         [
             'name' => 'Ghana',
             'code' => 233,
             'key' => 'GHS',
         ],
         [
            'name' => 'Nigeria',
            'code' => 234,
            'key' => 'NGN',
         ]
     ];
     foreach($roles as $key=>$value){
        CountryModel::create($value);
        }
   }
}