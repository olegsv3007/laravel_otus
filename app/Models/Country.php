<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    public  $timestamps = false;
    protected $guarded = [];

    /**
     * @return HasMany
     * Метод для получения всех городов в стране
     */
    public function cities(): hasMany
    {
        return $this->hasMany(City::class);
    }

    /**
     * @return HasManyThrough
     * Метод для получения всех отелей находящихся в стране
     */
    public function hotels(): HasManyThrough
    {
        return $this->hasManyThrough(Hotel::class, City::class);
    }
}
