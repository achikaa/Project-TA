<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailScheduleLine extends Model
{
    use HasFactory;
    // table
    protected $table = 'detail_schedule_line';

    protected $fillable = [
        'id', 'id_detail_meeting','nama_proses','deskripsi','incoming_date','lead_time','remark','approve','file','updated_at','created_by','updated_by',
    ];
}
