<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Food extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'description'];


    protected $fillable = [
        'type', 'date'
    ];


    public function meals(){
        return $this->hasMany(Meal::class);
    }

    public function types(){
        return $this->hasMany(Type::class);
    }

}
