<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationSequence extends Model
{
    protected $guarded = [];
    protected $casts = ['year' => 'integer', 'last_sequence' => 'integer'];
}
