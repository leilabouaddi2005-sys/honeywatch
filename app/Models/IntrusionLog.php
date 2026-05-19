<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IntrusionLog extends Model
{
    protected $fillable = [
        'honeypot_id',
        'ip_address',
        'user_agent',
        'payload',
        'country',
        'city',
        'risk_score',
        'timestamp',
    ];

    protected $casts = [
        'payload' => 'array',
        'timestamp' => 'datetime',
    ];

    public function honeypot(): BelongsTo
    {
        return $this->belongsTo(Honeypot::class);
    }
}