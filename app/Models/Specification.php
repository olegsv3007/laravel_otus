<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Specification extends Model
{
    use HasFactory;

    public const TYPE_SELECT = 1;
    public const TYPE_CHECKBOX = 2;
    public const TYPE_TEXT = 3;

    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return HasMany
     * Метод для получения всех возможных вариантов для характеристики
     */
    public function variants(): HasMany
    {
        return $this->HasMany(SpecificationVariant::class);
    }

    /**
     * @return MorphToMany
     * Метод для получения всех отелей имеющих характеристику
     */
    public function hotels(): MorphToMany
    {
        return $this->morphedByMany(Hotel::class, 'specificationable');
    }

    /**
     * @return MorphToMany
     * Метод для получения всех апартаментов имеющих характеристику
     */
    public function apartments(): MorphToMany
    {
        return $this->morphedByMany(Apartment::class, 'specificationable');
    }
}
