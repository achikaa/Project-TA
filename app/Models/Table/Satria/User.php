<?php

namespace App\Models\Table\Satria;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'users';

    protected $fillable = [
        'id', 'name', 'email','email_sf', 'departement'
    ];
}