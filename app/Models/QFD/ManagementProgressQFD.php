<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class ManagementProgressQFD extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ms_proses';

    protected $fillable = [
        'id', 'proses','flag','created_at','created_by', 'updated_at', 'updated_by'
    ];
}