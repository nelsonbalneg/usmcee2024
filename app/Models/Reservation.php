<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    // Define the relationship to the User model
    public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Other relationships like room and ceesession can stay as they are
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function ceesession()
    {
        return $this->belongsTo(CeeSession::class, 'cee_session_id');
    }

}
