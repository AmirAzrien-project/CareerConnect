<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'phone_number',
        'profile_picture',
        'resume',
        'advisor',
        'cover_letter',
        'current_position',
        'company',
        'company_name',
        'company_state',
        'company_city',
        'latitude',
        'longitude',
        'location',
        'state',
        'city',
        'part',
        'student_course',
        'faculty',
        'registration_date',
        'last_login_date',
        'selia',
        'student_id',
        'user_id',
        'no_ic',
        'penyelia_id',
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
        'password' => 'hashed',
    ];

    public function mohon()
    {
        return $this->hasOne(Mohon::class);
        //return $this->hasMany('App\Models\Mohon', 'user_id');
    }

    public function dokumenMohon()
    {
        return $this->hasMany('App\Models\Mohon', 'user_id', 'id');
    }

    // Relationship to Selia (as Penyelia)
    public function students()
    {
        return $this->hasMany(Selia::class, 'penyelia_id', 'user_id'); // 'penyelia_id' in Selia, 'user_id' in User
    }

    // Relationship to Selia (as Student)
    public function penyelia()
    {
        return $this->belongsTo(Selia::class, 'student_id', 'user_id'); // 'student_id' in Selia, 'user_id' in User
    }

    // Relationship to Terima table
    public function terima()
    {
        return $this->hasOne(Terima::class, 'id', 'user_id', 'user_id', 'student_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'student_id', 'user_id');
    }
}
