<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class DetailMeetingQFD extends Model
{
    protected $connection = 'mysql';
    protected $table = 'detail_meeting_qfd';

    protected $fillable = [
        'id', 'idQfd', 'MeetingOrganizer','Location','ReportedBy','MeetingDate','meeting_ke','status','notes','flag','created_at','updated_at','created_by','updated_by'
    ];
}