<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantsController extends Controller
{
    public function index(){

        $coach = Auth::user();

        $participants =  $coach->participants()->whereStatus('active')->get() ;

        return view('coach.participant.index',[
            'participants' => $participants,
        ]);
    }



    public function view($id){

        $participant = User::findOrFail($id);
        $medicalinfos = $participant->medicalinfos()->latest()->first();
        return view('coach.participant.view',compact('participant','medicalinfos'));
    }


    public function document($id){

        $participant = User::findOrFail($id);
        $medicalinfos = $participant->medicalinfos()->latest()->first();
        $files = $participant->files()->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();
        return view('coach.participant.document',compact('participant','medicalinfos','files'));
    }


}
