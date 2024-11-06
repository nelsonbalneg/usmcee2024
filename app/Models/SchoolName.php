<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolName extends Model
{
    protected $table = 'school_names'; // Explicitly defining the table name
    protected $fillable = [
        'schoolid',
        'school_name',
        'school_address',
    ];
}
