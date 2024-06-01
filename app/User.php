<?php

namespace App;
use Laravel\Passport\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'username',
        'password',
        'previlage',
        'remember_token',
        'api_token',
        'fakultas',
        'fakpanjang',
        'merangkap',
        'nip',
        'golongan',
        'email',
        'spesial',
        'tandatangan',
        'paraf',
        'firebaseid',
        'photo',
        'klsajar',
        'smt',
        'tapel',
        'nik',
        'semester',
        'status',
        'id_sekolah',
        'created_by',
        'updated_by',
        'active_status',
        'avatar',
        'dark_mode',
        'messenger_color',
    ];
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
}
