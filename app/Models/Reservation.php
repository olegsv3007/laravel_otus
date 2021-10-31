<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'date_start',
        'date_end',
        'created_at',
        'updated_at_at',
    ];

    /**
     * @return BelongsTo
     * Метод для получения пользователя оформившего бронь
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     * Метод для получения апартаментов на которые оформлена бронь
     */
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    /**
     * @return BelongsTo
     *  Метод для получения статуса брони
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
