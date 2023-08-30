<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $translatable = ['description'];

    protected $fillable = [
        'feature_id', 'description', 'is_active',
    ];


    public function feature(){
        return $this->belongsTo(Feature::class);
    }

    public function plans(){
        return $this->belongsToMany(Plan::class,'plan_services');
    }
}
