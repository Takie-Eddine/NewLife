<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Type extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['type'];


    protected $fillable = [
        'food_id','type',
    ];

    public function meals(){
        return $this->hasMany(Meal::class);
    }
}
