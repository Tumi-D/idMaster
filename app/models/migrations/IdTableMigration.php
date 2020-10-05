<?php

use Illuminate\Database\Capsule\Manager as Migration;

class IdTableMigration  extends Migration
{

    public static function handle()
    {
        self::schema()->dropIfExists('id');
        self::schema()->create('id', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
        });
    }
}
