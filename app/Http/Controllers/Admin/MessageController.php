<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Coach;
use App\Models\Message;
use App\Models\User;
use App\Rules\EmailExists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
    public function index(){

        $admin = Auth::user('admin');

        $messages = Message::where('from',$admin->email)->orWhere('to',$admin->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();


        return view('admin.message.index',compact('messages'));
    }


    public function create(){

        $coaches = Coach::all();
        $admins = User::all();
        return view('admin.message.create',compact('coaches','admins'));
    }


    public function store(Request $request){

        //return $request ;
        $request->validate([
            'from' => ['required',Rule::exists('admins','email')],
            'to' => ['required'],
            'cc' => ['nullable',],
            'subject' => ['nullable','string','max:190'],
            'text' => ['required',],
        ]);

        foreach ($request->to as $to) {
            $message = Message::create([
                'from' => $request->from,
                'to' => $to,
                'cc' => $request->cc,
                'subject' => $request->subject,
                'text' =>  $request->text,
            ]);
        }
        toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->route('admin.messages');

    }


    public function send(){
        $admin = Auth::user('admin');

        $messages = Message::where('from',$admin->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();


        return view('admin.message.index',compact('messages'));
    }
}
