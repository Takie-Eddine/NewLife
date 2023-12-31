<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function index(){

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


        return view('coach.calender.index',compact('events'));
    }
}
