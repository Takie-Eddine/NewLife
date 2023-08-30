<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMedicalInfo extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id', 'weight', 'height', 'blood_type', 'sugar', 'tension',
        'oxygene', 'sleep_hours',
    ];



    public function user(){
        return $this->belongsTo(User::class,'user_id' , 'id');
    }
}
