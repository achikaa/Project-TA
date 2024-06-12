<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class Bapi extends Model
{
    protected $connection = 'mysql';
    protected $table = 'bapi_po_interco';

    protected $fillable = [
        'PONUM','PRODUCT','PRODUCTDESC','QTY','REQDELIVDATPO','ENDCUSTNAME','CUSTNAME', 'UOM', 'MATGROUP', 'ENDCUSTPO',
    ];
}