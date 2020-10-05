<?php
/**
*You can  use eloquent along with the inbuilt tableDataObject trait
*Create something  awesome.
**/
use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = "country";
    protected $guarded = [];
    //protected $primaryKey = 'countryid';
    public $timestamps = false;

}
