<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasUlids;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'first_name',
        'email',
        'password',
        'news_letter',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function supportMessages()
    {
        return $this->hasMany(SupportMessage::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function getNameColumn()
    {
        return $this->name;
    }
    public function getValueNameColumn()
    {
        return "L'utilisateur";
    }
    public static function findOrCreateGoogleUser($googleUser)
    {
        $googleData=$googleUser->user;
        //Premier tableau pour la recherche, si il ne trouve rien il fait le 2eme tableau
        return self::firstOrCreate(['email' => $googleData['email']],
        ['google_id'=>$googleData['sub'],
        'name' => $googleData['family_name'],
        'email' => $googleData['email'],
        'first_name'=>$googleData['given_name'],
        'password' => bcrypt(Str::random(16)),
        'email_verified_at' => now()]);
    }
}
