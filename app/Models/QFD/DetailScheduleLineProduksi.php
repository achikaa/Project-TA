<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailScheduleLineProduksi extends Model
{
    use HasFactory;

    // table
    protected $table = 'detail_schedule_line_produksi';

    protected $fillable = [
        'id', 'id_detail_meeting','nama_proses','deskripsi','start_date','finish_date','updated_at','created_by','updated_by',
    ];
}
