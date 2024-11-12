<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    protected $fillable = [
        'app_no',
        'lrn',
        'firstname',
        'lastname',
        'birthdate',
        'exam_session',
        'room_id'
    ];
}
