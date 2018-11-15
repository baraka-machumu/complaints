<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Complainer extends Model
{

    protected $table  ="complainer";

    protected $primaryKey ="complainer_id";

    public static function complainerDetail($complaint_id)
    {
        $details = DB::table('vw_complaints')
            ->where('complaint_id',$complaint_id)
            ->first();
        return $details;

    }
}
