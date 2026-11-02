<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    /**
     * Daftar status pendaftaran: nilai di database => label dan warna badge.
     */
    public const STATUSES = [
        'waiting' => ['label' => 'Menunggu', 'badge' => 'text-bg-warning'],
        'done' => ['label' => 'Selesai', 'badge' => 'text-bg-success'],
        'cancelled' => ['label' => 'Dibatalkan', 'badge' => 'text-bg-danger'],
    ];

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'registration_date',
        'complaint',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'registration_date' => 'date',
        ];
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status]['label'] ?? (string) $this->status;
    }

    public function statusBadge(): string
    {
        return self::STATUSES[$this->status]['badge'] ?? 'text-bg-secondary';
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
