<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSchedulePbFinish extends Model
{
    use HasFactory;

    // table
    protected $table = 'detail_schedule_pb_finish';

    protected $fillable = [
        'id', 'id_detail_meeting','nama_proses','deskripsi','material_readiness','pb_supply','start_date','end_date','lead_time','remark','approve','file','updated_at','created_by','updated_by',
    ];
}
