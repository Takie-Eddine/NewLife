<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Plan extends Model
{
    use HasFactory, HasTranslations, SearchableTrait;

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'program_id', 'name', 'description', 'photo', 'is_active',
    ];

    protected $searchable = [

        'columns' => [
            'plans.name' => 10,
        ],
    ];


    public function program(){
        return $this->belongsTo(program::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class,'plan_services')
                ->using(PlanService::class)
                ->as('plan_service')
                ->withPivot([
                    'is_checked', 'number', 'description'
                ]);
    }

}
