<?php

Class  Countries  extends Controller
{
    public  function index(){
        //Return view
        $countries = CountryModel::all();
        echo json_encode($countries);
       // $this->view("pages/Countries");
    }
    
}
