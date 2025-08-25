<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactFollowUp extends Model
{
    protected $fillable = [
        'contact_id',
        'status',
        'notes',
        'follow_up_date',
        'next_follow_up_date',
        'outcome',
        'follow_up_type',
    ];

    protected $casts = [
        'follow_up_date' => 'datetime',
        'next_follow_up_date' => 'datetime',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
