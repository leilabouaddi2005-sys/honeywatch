<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Honeypot extends Model
{
    protected $fillable = [
        'name',
        'type',
        'url_slug',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function intrusionLogs(): HasMany
    {
        return $this->hasMany(IntrusionLog::class);
    }
}