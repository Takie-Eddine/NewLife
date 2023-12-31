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
        $participants = User::all();
        return view('admin.message.create',compact('coaches','participants'));
    }

    public function createcoach(){
        $coaches = Coach::all();
        $participants = User::all();
        return view('admin.message.createcoach',compact('coaches','participants'));
    }


    // public function store(Request $request){

    //     //return $request ;
    //     $request->validate([
    //         'from' => ['required',Rule::exists('admins','email')],
    //         'to' => ['required'],
    //         'cc' => ['nullable',],
    //         'subject' => ['nullable','string','max:190'],
    //         'text' => ['required',],
    //     ]);

    //     foreach ($request->to as $to) {
    //         $message = Message::create([
    //             'from' => $request->from,
    //             'to' => $to,
    //             'cc' => $request->cc,
    //             'subject' => $request->subject,
    //             'text' =>  $request->text,
    //         ]);
    //     }
    //     toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
    //     return redirect()->route('admin.messages');

    // }

    public function store(Request $request){

        $request->validate([
            'from' => ['required', Rule::exists('admins','email')],
            'to' => ['required', Rule::exists('users','email')],
            'cc' => ['nullable',],
            'subject' => ['nullable','string','max:190'],
            'text' => ['required',],
        ]);

        $participant= User::where('email','=',$request->to)->first();

        foreach ($request->to as $to) {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'sender_type' => 'admin',
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
        return redirect()->route('admin.messages');

    }

    public function storecoach(Request $request){


        $request->validate([
            'from' => ['required', Rule::exists('admins','email')],
            'to' => ['required', Rule::exists('coaches','email')],
            'cc' => ['nullable',],
            'subject' => ['nullable','string','max:190'],
            'text' => ['required',],
        ]);

        $admin = Coach::where('email','=',$request->to)->first();

        foreach ($request->to as $to) {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'sender_type' => 'admin',
                'reciver_id' => $admin->id,
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

    public function recive(){
        $admin = Auth::user('admin');

        $messages = Message::where('to',$admin->email)
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();


        return view('admin.message.index',compact('messages'));
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

        return view('admin.message.view',compact('message','reciver','sender'));

    }


}
