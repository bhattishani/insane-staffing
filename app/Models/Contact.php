<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'inquiry_type',
        'message',
        'cv_path',
        'ip_address',
        'country',
        'city',
        'device_fingerprint',
        'spam_score',
        'follow_up_notes',
        'last_follow_up',
        'status'
    ];

    public function followUps(): HasMany
    {
        return $this->hasMany(ContactFollowUp::class)->latest();
    }
}
