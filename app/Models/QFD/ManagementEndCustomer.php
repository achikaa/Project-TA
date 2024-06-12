<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class ManagementEndCustomer extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ms_end_customer';

    protected $fillable = [
        'id', 'customer_code','customer_desc','alias','street','city','postal_code','title','flag','created_at','created_by', 'updated_at', 'updated_by'
    ];
}