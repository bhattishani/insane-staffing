<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'inquiry_type',
        'message',
        'attachment_paths',
        'ip_address',
        'country',
        'city',
        'device_fingerprint',
        'spam_score',
        'follow_up_notes',
        'last_follow_up',
        'status'
    ];

    protected $casts = [
        'attachment_paths' => 'array',
    ];

    public function followUps(): HasMany
    {
        return $this->hasMany(ContactFollowUp::class)->latest();
    }
}
