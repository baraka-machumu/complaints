<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    public static function getSchemes()
    {
        return Scheme::all('scheme_id', 'scheme_name');
    }
}
