<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasFactory, HasTranslations ;

    public $translatable = ['name'];

    protected $fillable = [
        'program_id', 'name', 'is_active',
    ];


    public function program(){
        return $this->belongsTo(program::class);
    }


    public function services(){
        return $this->hasMany(Service::class);
    }

}
