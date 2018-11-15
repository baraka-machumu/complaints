<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Response extends Model
{

    protected $table  ="response";

    protected $primaryKey ="response_id";

    public static function responseDetail($complaint_id)
    {
        $details = DB::table('response')
            ->select('*')
            ->where('complaint_id', '=', $complaint_id)
            ->get();
        return $details;

    }
}
