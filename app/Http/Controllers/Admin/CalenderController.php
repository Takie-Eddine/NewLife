<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CalenderController extends Controller
{
    public function index(){

        $participants = User::all();
        $coaches = Coach::all();
        $events = [];
        $calendars = Calendar::all();


        foreach ($calendars as $calendar) {
            $events[] = [
                'title' => $calendar->title,
                'start' => $calendar->start_date,
                'end' => $calendar->end_date,
            ];
        }


        return view('admin.calender.index',compact('coaches','participants','events'));
    }




    public function store(Request $request){

        return $request ;

        $request->validate([
            'name' => ['required','min:4','string'],
            'description' => ['required','min:4','string'],
            'start_date' => ['required','date'],
            'start_time' => ['required','date_format:H:i'],
            'end_date' => ['required','date'],
            'end_time' => ['required','date_format:H:i'],
            'participants' => ['required',Rule::exists('users','id')],
            'coaches' => ['required',Rule::exists('coaches','id')],
        ]);


        $calendar = Calendar::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
        ]);


        $calendar->participants()->sync($request->participants);
        $calendar->coaches()->sync($request->coaches);

        toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->route('admin.calenders');

    }

    public function view($id){

    }
}
