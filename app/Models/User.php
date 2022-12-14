<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'email', 'password','isAdmin','role','profile_photo_path'
=======
<<<<<<< HEAD
        'name', 'email', 'password','isAdmin'
=======
        'name', 'email', 'password','isAdmin','role'
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
>>>>>>> 55eecffa7e44b946ac5fa007165d181af020a851
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get all of the demandes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
