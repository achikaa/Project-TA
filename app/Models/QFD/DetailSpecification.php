<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class DetailSpecification extends Model
{
    protected $connection = 'mysql';
    protected $table = 'detail_spesifikasi';

    protected $fillable = [
        'id', 'IdQfd','po_interco','MaterialNumber','DesMaterial','QtyMaterial','status','stock','product_number','product_number_desc','qty','lead_time','pic','Remark','created_at','updated_at','created_by','updated_by',
    ];
}