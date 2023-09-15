<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;


    protected $fillable = [
        'title', 'description', 'start_date',  'end_date',
    ];


    public function coaches(){
        return $this->belongsToMany(Coach::class,'calendar_coaches');
    }

    public function participants(){
        return $this->belongsToMany(User::class,'calendar_participants');
    }
}
