<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results'; // Explicitly defining the table name

    public function cee_term()
    {
        return $this->belongsTo(CeeSession::class, 'cee_session_id');
    }
}
