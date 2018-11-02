<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplaintType extends Model
{
    protected $fillable = [
        'complaint_type_name'
    ];

    public static function getComplaintType()
    {
        return ComplaintType::all('complaint_type_id', 'complaint_type_name');
    }
}
