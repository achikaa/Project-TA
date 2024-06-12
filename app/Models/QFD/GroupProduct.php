<?php

namespace App\Models\QFD;

use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'material_hasil_olah';

    protected $fillable = [
        'id', 'production_order', 'product_number', 'product_description', 'group_product', 'order_quantity', 'sch_start_date', 'sch_finis_date', 'status', 'tanggal_dlv', 'material_number', 'material_description', 
        'operation', 'opr_short_text', 'plant', 'storage_location', 'base_unit', 'material_type', 'material_group', 'requirement_date', 'requrement_quantity', 'good_issue', 'stock', 'in_qc', 'final_issue', 'deletion_flag', 'updated_at',
    ];
}