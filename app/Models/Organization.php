<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return HasMany
     * Метод для получения пользователей имеющих право на управление организацией
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех отелей относящихся к организации
     */
    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }
}
