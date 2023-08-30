<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Touristfacilitie extends Model
{
    use HasFactory , SearchableTrait;


    public $translatable = ['name', 'description' ,'type'];

    protected $fillable = [
        'name', 'description', 'type',
    ];
    protected $searchable = [

        'columns' => [
            'touristfacilities.name' => 10,
        ],
    ];

    public function images(){
        return $this->hasMany(FacilityImage::class, 'touristfacilitie_id', 'id');
    }


}
