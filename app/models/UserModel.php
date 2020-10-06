<?php
/**
*You can  use eloquent along with the inbuilt tableDataObject trait
*Create something  awesome.
**/
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $guarded = [];
    public $timestamp = false;
    //protected $primaryKey = 'userid';
    //protected $timestamp = null;

}
