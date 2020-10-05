<?php
/**
*You can  use eloquent instead of the in built tableDataObject class
*Create something  awesome.
**/
use Illuminate\Database\Eloquent\Model;

class IdModel extends Model
{
    protected $table = "id";
    protected $guarded = [];
    //protected $primaryKey = 'idid';
    //protected $timestamp = null;

}
