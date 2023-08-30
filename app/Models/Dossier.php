<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Dossier extends Model
{
    use HasFactory, HasTranslations, SearchableTrait;

    public $translatable = ['name'];

    protected $fillable = [
        'name', 'photo',
    ];

    protected $searchable = [

        'columns' => [
            'dossiers.name' => 10,
        ],
    ];


    public function files(){
        return $this->hasMany(File::class);
    }

}
