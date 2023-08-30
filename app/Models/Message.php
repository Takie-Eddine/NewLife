<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Message extends Model
{
    use HasFactory, SearchableTrait;


    protected $fillable = [
        'from', 'to', 'subject', 'cc', 'text',
    ];


    protected $searchable = [

        'columns' => [
            'messages.from' => 10,
            'messages.to' => 10,
            'messages.subject' => 10,
        ],
    ];

}
