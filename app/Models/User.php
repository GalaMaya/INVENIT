<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        "name",
        "email",
        "password"
    ];

    protected $hidden = [
        "password",
        "email_verified_at",
        "remember_token"
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Semua riwayat assignment user ini (aset yang pernah/sedang dipegang)
     */
    public function assetAssignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class);
    }

    /**
     * Aset yang SEKARANG sedang dipegang user ini
     */
    public function currentAssets()
    {
        return $this->hasMany(AssetAssignment::class)->whereNull('returned_at')->with('asset');
    }

    /**
     * Shortcut: daftar aset yang sedang dipegang (collection of Asset)
     */
    public function getCurrentAssetsListAttribute()
    {
        return $this->currentAssets->pluck('asset');
    }
}
