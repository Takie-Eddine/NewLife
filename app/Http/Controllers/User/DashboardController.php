<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Food;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $food = Food::whereDate('date',Carbon::today())->first();

        $events = array();
        $calendars = Calendar::all();


        foreach ($calendars as $calendar) {
            $events[] = [
                'id' => $calendar->id,
                'title' => $calendar->title,
                'start' => $calendar->start_date,
                'end' => $calendar->end_date,
            ];
        }
        return view('user.user',compact('food','events'));
    }
}
