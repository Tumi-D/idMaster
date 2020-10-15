<?php

use Illuminate\Database\Capsule\Manager as Migration;

class UserTableMigration  extends Migration
{

    public static function handle()
    {
        self::schema()->dropIfExists('users');
        self::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('firstname')->nullable();
            $table->string('phone');
            $table->string('lastname')->nullable();
            $table->string('country')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }
}
