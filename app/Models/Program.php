<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Program extends Model
{
    use HasFactory, HasTranslations, SearchableTrait;


    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name', 'description', 'photo', 'is_active',
    ];

    protected $searchable = [

        'columns' => [
            'programs.name' => 10,
        ],
    ];

    public function plans(){
        return $this->hasMany(Plan::class);
    }
    public function features(){
        return $this->hasMany(Feature::class);
    }

}
