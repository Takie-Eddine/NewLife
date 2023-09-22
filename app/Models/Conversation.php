<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_email',
        'reciver_email',
        'sender_id',
        'reciver_id',
        'sender_type',
        'reciver_type',
        'last_time_message',
    ];



    public function messages(){
        return $this->hasMany(Chat::class);
    }






}
