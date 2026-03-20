<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsPolicy extends Model
{
     protected $fillable = [
        'title',
        'content',
        'version',
        'is_active',
        'effective_date',
    ];

    public function acceptances()
    {
        return $this->hasMany(TermsPolicyAcceptance::class);
    }
}
