<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class ManagementTruck extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ms_truck';

    protected $fillable = [
        'id', 'truck', 'flag','created_at', 'created_by', 'updated_at', 'updated_by'
    ];
}