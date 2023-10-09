<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Calendar;
use App\Models\Coach;
use App\Models\Food;
use App\Models\Program;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(){

        $users = User::all();

        $coaches = Coach::all();

        $admins = Admin::all();

        $tasks = Task::whereNot('status','Completed')->where('admin_id',Auth::user()->id)->get();

        $programs = Program::all();

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

        return view('admin.admin',compact('users','coaches','admins','tasks','events','programs','food'));
    }

}
