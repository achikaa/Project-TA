<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class QualityForDelivery extends Model
{
    protected $connection = 'mysql';
    protected $table = 'trx_qfd';

    protected $fillable = [
        'id', 'idQfd', 'customer', 'end_customer','projectName','customerpo','po_interco','product_no','product_desc','product_group','product_group_ima','qty','uom','reqDelivery','no_qfd','truck','noprelim','paintingstyle','assykeunit','Customer','end_customer', 'flag',
    ];
}