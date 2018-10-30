<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseType extends Model
{

    protected $table ="responsetype";
    public  function responseType(){

        return ResponseType::all()->toArray();
    }


}
