<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo',
        'role',
    ];
protected $searchable = [

        'columns' => [
            'contacts.name' => 10,
            'contacts.email' => 10,
            'contacts.phone' => 10,
        ],
    ];
}
