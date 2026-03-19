<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requirements extends Model
{
    use HasFactory;

    protected $table = 'requirements'; // Explicitly define table name (optional)

    protected $fillable = [
        'user_id',
        'psa',
        'tor',
        'shs_card',
        'enrolment_certification',
        'good_moral_char',
        'honorable_dismisal',
        'req_status',
        'hepa_b_test',
        'chest_x_ray',
        'preg_test',
        'signature',
        'photo',
        'unpost_count',
        'cee_session_id'
    ];
}
