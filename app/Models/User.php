<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_MODERATOR = 'moderator';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     * Получить все роли относящиеся к пользователю
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @return HasMany
     * Получить всю историю просмотров пользователя
     */
    public function  historyViews(): HasMany
    {
        return $this->hasMany(HistoryView::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех отзывов оставленных пользователем
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return HasMany
     * Метод для получения всех броней пользователя
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * @param string $role
     * @return bool
     * Метод проверяющий, есть ли у пользователя заданная роль
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()
            ->where('name' , $role)
            ->exists();
    }

    /**
     * @return bool
     * Метод проверяющий, есть ли у пользователя роль администратора
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    /**
     * @return bool
     * Метод проверяющий, есть ли у пользователя роль менеджера
     */
    public function getIsManagerAttribute(): bool
    {
        return $this->hasRole(self::ROLE_MANAGER);
    }

    /**
     * @return bool
     * Метод проверяющий, есть ли у пользователя роль модератора
     */
    public function getIsModeratorAttribute(): bool
    {
        return $this->hasRole(self::ROLE_MODERATOR);
    }

}
