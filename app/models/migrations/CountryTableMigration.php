<?php

use Illuminate\Database\Capsule\Manager as Migration;

class CountryTableMigration  extends Migration
{

    public static function handle()
    {
        self::schema()->dropIfExists('country');
        self::schema()->create('country', function ($table) {
            $table->increments('id');
            $table->string("name");
            $table->string("code");
            $table->string("key")->unique();
        });
    }
}
