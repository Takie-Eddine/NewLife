<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'permissions' // json field
    ];



    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }


    public function admins(){
        return $this->hasMany(Admin::class);
    }
}
