<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class File extends Model
{
    use HasFactory, HasTranslations, SearchableTrait, SoftDeletes;

    public $translatable = ['name'];

    protected $fillable = [
        'name', 'user_id', 'dossier_id'
    ];
    protected $searchable = [

        'columns' => [
            'files.name' => 10,
        ],
    ];

    public function dossier(){
        return $this->belongsTo(Dossier::class);
    }

    public function participant(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
