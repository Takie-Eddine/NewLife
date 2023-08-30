<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SearchableTrait,   SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'program_id',
        'plan_id',
        'status'
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


    protected $searchable = [

        'columns' => [
            'users.name' => 10,
            'users.email' => 10,
        ],
    ];


    public function profile(){
        return $this->hasOne(UserProfile::class,'user_id' , 'id')
        ->withDefault();
    }

    public function medicalinfos(){
        return $this->hasMany(UserMedicalInfo::class, 'user_id', 'id');
    }

    public function program(){
        return $this->belongsTo(Program::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class,'plan_id','id');
    }

    public function files(){
        return $this->hasMany(File::class,'user_id','id');
    }


    public function coaches(){
        return $this->belongsToMany(Coach::class,'coach_participants');
    }

    public function food(){
        return $this->hasMany(FoodSuggestion::class);
    }
}
