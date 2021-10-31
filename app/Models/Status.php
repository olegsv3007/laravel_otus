<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'Pending';
    public const STATUS_WAIT_FOR_PAYMENT = 'Wait for payment';
    public const STATUS_PAYED = 'Payed';
    public const STATUS_CANCEL = 'Cancel';
    public const STATUS_PAYMENT_EXPIRED = 'Payment expired';
    public const STATUS_SUCCESS = 'Success';

    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return HasMany
     * Метод для получения всех броней имеющих этот статус
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getBootstrapClassAttribute(): string
    {
        return match ($this->title) {
            static::STATUS_CANCEL => 'danger',
            static::STATUS_PAYED => 'success',
            default => 'warning',
        };
    }
}
