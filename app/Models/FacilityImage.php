<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FacilityImage extends Model
{
    use HasFactory;



    protected $fillable = [
        'name', 'touristfacilitie_id',
    ];



    public function facility(){
        return $this->belongsTo(Touristfacilitie::class, 'touristfacilitie_id', 'id');
    }


    public function getImageUrlAttribute(){

        if(!$this->name){
            return asset('images/no-image.png');
        }

        if (Str::startsWith($this->name,['http://' , 'https://'])) {
            return $this->name;
        }

        return asset('images/facility/' .$this->name);

    }
}
