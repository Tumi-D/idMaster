<?php

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Migration;

class OTPTableMigration  extends Migration
{

    public static function handle()
    {
        self::schema()->dropIfExists('OTP');
        self::schema()->create('OTP', function ($table) {
            $table->increments('id');
            $table->bigInteger('pin');
            $table->boolean('confirmed')->default(false);
            $table->dateTime('expires_at')->default(Carbon::now());
            $table->bigInteger('user_id');
        });
    }
}
