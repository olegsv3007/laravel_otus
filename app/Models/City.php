<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return BelongsTo
     * Метод для получения страны в которой находится город
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех отелей расположенных в городе
     */
    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }

    /**
     * @return HasManyThrough
     * Метод для получения всех апартаментов расположенных в городе
     */
    public function apartments(): HasManyThrough
    {
        return $this->hasManyThrough(Apartment::class, Hotel::class);
    }
}
