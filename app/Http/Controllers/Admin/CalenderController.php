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


        return view('admin.calender.index',compact('events'));
    }




    public function store(Request $request){

        //return $request ;

        $request->validate([
            'title' => ['required','min:190','max:x','string'],
            'description' => ['required','min:4','max:190','string'],
        ]);


        $calendar = Calendar::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);


        return response()->json($calendar);


        // $calendar->participants()->sync($request->participants);
        // $calendar->coaches()->sync($request->coaches);

        // toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
        // return redirect()->route('admin.calenders');

    }

    public function update(Request $request, $id){
        $calendar = Calendar::find($id);

        if (! $calendar) {
            return response()->json([
                'error' => 'Unable to find event'
            ],404);
        };

        $calendar->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json('Event Updated');

    }


    public function destroy($id){
        $calendar = Calendar::find($id);

        if (! $calendar) {
            return response()->json([
                'error' => 'Unable to find event'
            ],404);
        };

        $calendar->delete();

        return $id;
    }
}
