<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'asatidz_id',
        'akses_modul',
        'previlage',
        'klsajar',
        'smt',
        'tapel',
        'semester',
        'id_sekolah',
    ];
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }
    public function examsCreated()
    {
        return $this->hasMany(\App\Models\Exam::class, 'created_by');
    }

    public function examParticipations()
    {
        return $this->hasMany(\App\Models\ExamParticipant::class, 'student_id');
    }

    public function answers()
    {
        return $this->hasMany(\App\Models\StudentAnswer::class, 'student_id');
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
