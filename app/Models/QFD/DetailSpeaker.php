<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class DetailSpeaker extends Model
{
    protected $connection = 'mysql';
    protected $table = 'detail_speaker';

    protected $fillable = [
        'id', 'id_detail_meeting','email_speaker','created_at','updated_at','created_by','updated_by',
    ];
}