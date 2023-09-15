<?php

namespace App\Models;

use App\Models\Scopes\MessageScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Message extends Model
{
    use HasFactory, SearchableTrait;


    protected $fillable = [
        'from', 'to', 'subject', 'cc', 'text',
        'sender_id', 'reciver_id', 'sender_type',
        'reciver_type', 'reply',
    ];


    protected $searchable = [

        'columns' => [
            'messages.from' => 10,
            'messages.to' => 10,
            'messages.subject' => 10,
        ],
    ];


    protected static function booted()
    {
        static::addGlobalScope('message', new MessageScope());
    }

}
