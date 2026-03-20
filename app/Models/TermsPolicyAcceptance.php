<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsPolicyAcceptance extends Model
{
      protected $fillable = [
        'user_id',
        'terms_policy_id',
        'accepted_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    public function policy()
    {
        return $this->belongsTo(TermsPolicy::class, 'terms_policy_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
