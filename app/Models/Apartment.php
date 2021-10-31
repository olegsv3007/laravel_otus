<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    public const FOLDER_PHOTOS = 'apartments';

    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new ActiveScope());
    }

    /**
     * @return BelongsTo
     * Метод для получения отеля к которому относятся апартаменты
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class)->withoutGlobalScope(new ActiveScope());
    }

    /**
     * @return HasMany
     * Метод для получения всех оформленных заказов на апартаменты
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех отзывов на апартаменты
     */
    public function reviews(): hasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return MorphToMany
     * Получение всех спецификаций относящихся к апартаментам
     */
    public function specifications(): MorphToMany
    {
        return $this->morphToMany(Specification::class, 'specificationable');
    }

    /**
     * @return MorphMany
     * Метод для получения всех изображений относящихся к апартаментам
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imaginable');
    }

    /**
     * @return string
     * Метод для получения URL к основному изображению апартаментов
     */
    public function getMainImageSrcAttribute(): string
    {
        return asset(Storage::disk('images')->url(self::FOLDER_PHOTOS . '/' . $this->main_image));
    }

}
