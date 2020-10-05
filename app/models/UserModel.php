<?php
/**
*You can  use eloquent along with the inbuilt tableDataObject trait
*Create something  awesome.
**/
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $guarded = [];
    //protected $primaryKey = 'userid';
    //protected $timestamp = null;

}
