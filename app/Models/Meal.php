<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Meal extends Model
{
    use HasFactory , HasTranslations;

    public $translatable = ['name', 'description'];


    protected $fillable = [
        'name', 'description', 'photo', 'food_id', 'type_id'
    ];

    public function food(){
        return $this->belongsTo(Food::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
