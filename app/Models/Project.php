<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractor_id',
        'foreman_id',
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'province',
        'city',
        'district',
        'village',
        'address',
        'total_price',
        'document_url',
        'fix_people',
        'transportation_fee',
        'already_paid',
        'payment_type',
        'wa_number',
    ];

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    public function foreman(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreman_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class);
    }
}
