<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function index(){

        return view('coach.calender.index');
    }
}
