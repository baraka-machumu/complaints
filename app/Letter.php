<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Letter extends Model
{
    public static function letterDetail($complaint_id)
    {
        $details = DB::table('letters')
            ->select('*')
            ->where('complaint_id', '=', $complaint_id)
            ->get();
        return $details;

    }

}
