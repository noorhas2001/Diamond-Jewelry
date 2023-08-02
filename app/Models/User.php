<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $email)
 * @method static find($id)
 * @method static count()
 * @method static paginate(int $int)
 * @method static typeUser()
 * @method static whereNotNull(string $string)
 * @method static inRandomOrder()
 * @property mixed $email
 * @property mixed $name
 * @property mixed $user_type
 * @property mixed $phone
 * @property mixed $password
 * @property mixed $email_verified_at
 * @property mixed $remember_token
 * @property mixed $address
 * @property mixed $avatar
 * @property mixed $plan_id
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, InteractsWithMedia;

    public const ADMIN = 'admin';
    public const User = 'user';
    public const SUPER_ADMIN_ROLE = 'super_admin';
    public const USER_ROLE = 'user';
    const USER_IMAGE_TAG = 'user_image';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'email_verified_at',
        'plan_id',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];



    public function addAssetImage($path, $image_tag)
    {
        return $this->addMediaFromUrl(url(asset($path)))->toMediaCollection($image_tag);
    }


    public function isAdmin(): bool
    {
        return $this->user_type == self::ADMIN;
    }

    public function scopeTypeAdmin($query)
    {
        return $query->where('user_type', self::ADMIN);
    }

    public function scopeTypeUser($query)
    {
        return $query->where('user_type', self::User);
    }

    public function imageUrl()
    {
        return Media::find($this->avatar)?->getUrl();
    }


    public function canDeleted(): bool
    {
        if ($this->hasRole(self::SUPER_ADMIN_ROLE)) {
            return false;
        } else {
            return true;
        }
    }

}
