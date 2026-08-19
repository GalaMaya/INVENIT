<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'user_id',
        'assigned_by',
        'assigned_at',
        'returned_at',
        'handover_notes',
    ];

    protected $casts = [
        'assigned_at'  => 'datetime',
        'returned_at'  => 'datetime',
    ];

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * User yang memegang aset (penerima)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * User (IT Admin) yang melakukan serah terima
     */
    public function assignedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    /**
     * Apakah assignment ini masih aktif?
     */
    public function getIsActiveAttribute(): bool
    {
        return is_null($this->returned_at);
    }
}