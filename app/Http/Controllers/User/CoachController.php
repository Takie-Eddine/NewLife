<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public function index(){

        $coaches = Coach::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })
        ->when(\request()->type != null, function ($query) {
            $query->whereType(\request()->type);
        })
        ->paginate(\request()->limit_by ?? 10);
        return view('user.coach.index', compact('coaches'));

    }



    public function view($id){
        $coach = Coach::findOrFail($id);
        return view('user.coach.view',compact('coach'));
    }




    // public function mycoaches($id){

    //     $user = Auth::user('web');
    //     $coaches = $user->coaches()->get();
    //     return view('user.coach.mycoaches',compact('coaches'));

    // }
}
