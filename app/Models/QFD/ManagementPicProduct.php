<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class ManagementPicProduct extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ms_pic_product';

    protected $fillable = [
        'id', 'name','inisial_nama','email','group_product','flag', 'created_at','created_by', 'updated_at', 'updated_by'
    ];
}