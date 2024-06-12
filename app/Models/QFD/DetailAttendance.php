<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class DetailAttendance extends Model
{
    protected $connection = 'mysql';
    protected $table = 'detail_attendance';

    protected $fillable = [
        'id', 'id_detail_meeting','Name','created_at','updated_at','created_by','updated_by',
    ];
}