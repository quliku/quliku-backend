<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForemanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_type',
        'status',
        'city',
        'wa_number',
        'classification',
        'description',
        'experience',
        'min_people',
        'max_people',
        'bank_type',
        'account_name',
        'account_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
