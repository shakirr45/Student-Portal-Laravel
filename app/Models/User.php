<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'user_id',
        'section_id',
        'session_id',
        'assign_class_id',
        'promote_class',
        'final_result',
        'demote_class',
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


    // public function classAssign()
    // {
    //     return $this->hasOne('App\Models\ClassAssign');
    // }

    // public function classWiseSubjectAssign()
    // {
    //     return $this->hasOne('App\Models\ClassWiseSubjectAssign');
    // }

    public function institutionClass()
    {
        return $this->belongsTo('App\Models\InstitutionClass', 'assign_class_id');
    }

    public function classSection()
    {
        return $this->belongsTo('App\Models\ClassSection', 'section_id');
    }

    public function sessionList()
    {
        return $this->belongsTo('App\Models\Session', 'session_id');
    }


    public function classAssign()
    {
        return $this->hasOne('App\Models\ClassAssign');
    }




}
