<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class DetailSchedule extends Model
{
    protected $connection = 'mysql';
    protected $table = 'detail_schedule';

    protected $fillable = [
        'id', 'id_proses', 'start_date','end_date','email_pic', 'remark', 'approve', 'file', 'created_at', 'updated_by', 'created_by', 'updated_by',
    ];
}