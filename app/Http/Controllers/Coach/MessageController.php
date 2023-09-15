<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Coach;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
    public function index(){

        $coach = Auth::user('coach');

        $messages = Message::where('from',$coach->email)->orWhere('to',$coach->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->orderBy('created_at', 'desc')
        ->paginate(10);


        return view('coach.message.index',compact('messages'));
    }


    public function create(){

        $admins = Admin::all();
        $participants = User::all();
        return view('coach.message.create',compact('participants','admins'));
    }


    public function createadmin(){
        $admins = Admin::all();
        $participants = User::all();
        return view('coach.message.createadmin',compact('participants','admins'));
    }


    public function store(Request $request){

        $request->validate([
            'from' => ['required', Rule::exists('coaches','email')],
            'to' => ['required', Rule::exists('users','email')],
            'cc' => ['nullable',],
            'subject' => ['nullable','string','max:190'],
            'text' => ['required',],
        ]);

        $participant= User::where('email','=',$request->to)->first();

        foreach ($request->to as $to) {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'sender_type' => 'coach',
                'reciver_id' => $participant->id ,
                'reciver_type' => 'user',
                'reply' => 0,
                'from' => $request->from,
                'to' => $to,
                'cc' => $request->cc,
                'subject' => $request->subject,
                'text' =>  $request->text,
            ]);
        }
        toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->route('coach.messages');

    }

    public function storeadmin(Request $request){


        $request->validate([
            'from' => ['required', Rule::exists('coaches','email')],
            'to' => ['required', Rule::exists('admins','email')],
            'cc' => ['nullable',],
            'subject' => ['nullable','string','max:190'],
            'text' => ['required',],
        ]);

        $admin = Admin::where('email','=',$request->to)->first();

        foreach ($request->to as $to) {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'sender_type' => 'coach',
                'reciver_id' => $admin->id,
                'reciver_type' => 'admin',
                'reply' => 0,
                'from' => $request->from,
                'to' => $to,
                'cc' => $request->cc,
                'subject' => $request->subject,
                'text' =>  $request->text,
            ]);
        }
        toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->route('coach.messages');

    }


    public function send(){
        $coach = Auth::user('coach');

        $messages = Message::where('from',$coach->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);


        return view('coach.message.index',compact('messages'));
    }

    public function recive(){
        $coach = Auth::user('coach');

        $messages = Message::where('to',$coach->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);


        return view('coach.message.index',compact('messages'));
    }


    public function view($id){

        $message = Message::findOrFail($id);

        // $coach = Coach::whereId($message->sender_id)->first();

        if ($message->reciver_type === 'coach') {
            $reciver = Coach::whereId($message->reciver_id)->first();
        }

        if ($message->reciver_type === 'admin') {
            $reciver = Admin::whereId($message->reciver_id)->first();
        }

        if ($message->reciver_type === 'user') {
            $reciver = User::whereId($message->reciver_id)->first();
        }

        if ($message->sender_type === 'coach') {
            $sender = Coach::whereId($message->sender_id)->first();
        }

        if ($message->sender_type === 'admin') {
            $sender = Admin::whereId($message->sender_id)->first();
        }

        if ($message->sender_type === 'user') {
            $sender = User::whereId($message->sender_id)->first();
        }

        return view('coach.message.view',compact('message','reciver','sender'));

    }
}
