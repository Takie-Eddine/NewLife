<?php

namespace App\Http\Controllers\User;

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

        $user = Auth::user('web');

        $messages = Message::where('from',$user->email)->orWhere('to',$user->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->orderBy('created_at', 'desc')
        ->paginate(10);


        return view('user.message.index',compact('messages'));
    }


    public function create(){

        $admins = Admin::all();
        $participants = Coach::all();
        return view('user.message.create',compact('participants','admins'));
    }


    public function createadmin(){
        $admins = Admin::all();
        $participants = Coach::all();
        return view('user.message.createadmin',compact('participants','admins'));
    }


    public function store(Request $request){

        $request->validate([
            'from' => ['required', Rule::exists('users','email')],
            'to' => ['required', Rule::exists('coaches','email')],
            'cc' => ['nullable',],
            'subject' => ['nullable','string','max:190'],
            'text' => ['required',],
        ]);

        $participant= Coach::where('email','=',$request->to)->first();

        foreach ($request->to as $to) {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'sender_type' => 'user',
                'reciver_id' => $participant->id ,
                'reciver_type' => 'coach',
                'reply' => 0,
                'from' => $request->from,
                'to' => $to,
                'cc' => $request->cc,
                'subject' => $request->subject,
                'text' =>  $request->text,
            ]);
        }
        toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->route('user.messages');

    }

    public function storeadmin(Request $request){


        $request->validate([
            'from' => ['required', Rule::exists('users','email')],
            'to' => ['required', Rule::exists('admins','email')],
            'cc' => ['nullable',],
            'subject' => ['nullable','string','max:190'],
            'text' => ['required',],
        ]);

        $admin = Admin::where('email','=',$request->to)->first();

        foreach ($request->to as $to) {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'sender_type' => 'user',
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
        return redirect()->route('user.messages');

    }


    public function send(){
        $user = Auth::user('web');

        $messages = Message::where('from',$user->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);


        return view('user.message.index',compact('messages'));
    }

    public function recive(){
        $user = Auth::user('web');

        $messages = Message::where('to',$user->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);


        return view('user.message.index',compact('messages'));
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

        return view('user.message.view',compact('message','reciver','sender'));

    }
}
