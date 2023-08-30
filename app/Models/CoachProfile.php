<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachProfile extends Model
{
    use HasFactory;

    protected $primaryKey = 'coach_id';


    protected $fillable = [
        'coach_id' , 'first_name' , 'last_name' , 'birthday' , 'gender' , 'street_address' ,
        'photo' , 'city' , 'state' , 'postal_code' , 'country' , 'locale' , 'phone',
    ];



    public function user(){
        return $this->belongsTo(Coach::class,'coach_id' , 'id');
    }
}
