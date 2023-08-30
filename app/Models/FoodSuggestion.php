<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FoodSuggestion extends Model
{
    use HasFactory, HasTranslations;


    public $translatable = ['name', 'description'];


    protected $fillable = [
        'name', 'user_id', 'description', 'photo', 'type', 'date'
    ];
    protected $casts = [
        'date' => 'datetime',
    ];



    public function user(){
        return $this->belongsTo(User::class);
    }
}
