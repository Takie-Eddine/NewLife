<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlanService extends Pivot
{
    use HasFactory;

    protected $table = 'plan_services';
    protected $fillable = [
        'plan_id', 'service_id', 'is_checked', 'number', 'description',
    ];


}
