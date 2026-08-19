<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'model',
        'serial_number',
        'status',
        'location',
        'purchase_date',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'status' => 'string',
    ];

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

    /**
     * Aset belongs to satu kategori
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Semua riwayat assignment (baik yang aktif maupun sudah kembali)
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class)->orderBy('assigned_at', 'desc');
    }

    /**
     * Assignment yang sedang aktif (returned_at = null)
     * Ini yang kita pakai untuk tahu "siapa yang sekarang pegang aset ini"
     */
    public function currentAssignment(): HasMany
    {
        return $this->hasMany(AssetAssignment::class)->whereNull('returned_at');
    }

    /**
     * Shortcut: User yang sekarang memegang aset ini (jika ada)
     */
    public function getCurrentHolderAttribute()
    {
        return $this->currentAssignment->first()?->user;
    }

    // ==========================================
    // SCOPES (untuk Livewire filter)
    // ==========================================

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', 'available');
    }

    public function scopeInUse(Builder $query): Builder
    {
        return $query->where('status', 'in_use');
    }

    public function scopeDamaged(Builder $query): Builder
    {
        return $query->where('status', 'damaged');
    }

    // ==========================================
    // ACCESSORS (untuk UI / Badge warna)
    // ==========================================

    /**
     * Label status yang lebih user-friendly
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'available' => 'Tersedia',
            'in_use'    => 'Digunakan',
            'damaged'   => 'Rusak',
            default     => ucfirst($this->status),
        };
    }

    /**
     * Warna badge untuk UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'available' => 'badge-success',
            'in_use'    => 'badge-primary',
            'damaged'   => 'badge-danger',
            default     => 'badge-info',
        };
    }

    /**
     * Helper: cek apakah aset tersedia
     */
    public function Available(): bool
    {
        return $this->status === 'available';
    }

    public function InUse(): bool
    {
        return $this->status === 'in_use';
    }

    public function Damaged(): bool
    {
        return $this->status === 'damaged';
    }
}