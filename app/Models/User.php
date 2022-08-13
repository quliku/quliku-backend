<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'profile_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wishlists(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists', 'contractor_id', 'foreman_id');
    }

    public function inWishlist(User $user): bool
    {
        return $this->belongsToMany(User::class, 'wishlists', 'foreman_id', 'contractor_id')
            ->where('contractor_id', $user->id)
            ->exists();
    }

    public function foremanDetail(): HasOne
    {
        return $this->hasOne(ForemanDetail::class);
    }

    public function foremanImages(): HasMany
    {
        return $this->hasMany(ForemanImage::class);
    }

    public function contractorProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'contractor_id');
    }

    public function foremanProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'foreman_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function reportImages(): HasMany
    {
        return $this->hasMany(ReportImage::class);
    }

    public function contractorRatings(): HasMany
    {
        return $this->hasMany(Rating::class, 'contractor_id');
    }

    public function foremanRatings(): HasMany
    {
        return $this->hasMany(Rating::class, 'foreman_id');
    }
}
