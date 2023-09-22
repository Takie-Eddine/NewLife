<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Coach;
use App\Models\Conversation;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index(){

        $admins = Admin::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->where('id', '<>', auth()->id())->get();

        $coaches = Coach::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        $users = User::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        return view('admin.chat.index',compact('admins','coaches','users'));
    }


    public function create_admin($id){



        $reciver = Admin::findOrFail($id);

        $sender = Auth::user();

        $conversation = Conversation::where('sender_email',$sender->email)->where('reciver_email',$reciver->email)
                                    ->orwhere('reciver_email',$sender->email)->where('sender_email',$reciver->email)->first();

        $conversations = Conversation::where('sender_email',$sender->email)->orwhere('reciver_email',$sender->email)->get();

        if(!$conversation){
            $conversation = Conversation::create([
                'sender_email' => $sender->email,
                'reciver_email' => $reciver->email,
                'last_time_message' => null,
            ]);
        }

        return view('admin.chat.chat',compact('sender','reciver','conversation','conversations'));

    }

    public function create_coach($id){

        $reciver = Coach::findOrFail($id);

        $sender = Auth::user();

        $conversation = Conversation::where('sender_email',$sender->email)->where('reciver_email',$reciver->email)
                                    ->orwhere('reciver_email',$sender->email)->where('sender_email',$reciver->email)->first();

        $conversations = Conversation::where('sender_email',$sender->email)->orwhere('reciver_email',$sender->email)->get();

        if(!$conversation){
            $conversation = Conversation::create([
                'sender_email' => $sender->email,
                'reciver_email' => $reciver->email,
                'last_time_message' => null,
            ]);
        }
        return view('admin.chat.chat',compact('sender','reciver','conversation','conversations'));

    }

    public function create_user($id){

        $reciver = User::findOrFail($id);

        $sender = Auth::user();

        $conversation = Conversation::where('sender_email',$sender->email)->where('reciver_email',$reciver->email)
                                    ->orwhere('reciver_email',$sender->email)->where('sender_email',$reciver->email)->first();

        $conversations = Conversation::where('sender_email',$sender->email)->orwhere('reciver_email',$sender->email)->get();

        if($conversation){
            $conversation = Conversation::create([
                'sender_email' => $sender->email,
                'reciver_email' => $reciver->email,
                'last_time_message' => null,
            ]);
        }
        return view('admin.chat.chat',compact('reciver','sender','conversation','conversations'));
    }




    public function getUsers(){

    }
}
