<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Coach;
use App\Models\Conversation;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ChatController extends Controller
{
    public function index(){


        $coaches = Coach::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        return view('user.chat.index',compact('coaches'));
    }



    public function create_coach($id){

        $coaches = Coach::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        $reciver = Coach::findOrFail($id);


        $sender = Auth::user();

        $conversation = Conversation::where('sender_email',$sender->email)->where('reciver_email',$reciver->email)
                                    ->orwhere('reciver_email',$sender->email)->where('sender_email',$reciver->email)
                                    ->first();

        $conversations = Conversation::where('sender_email',$sender->email)->orwhere('reciver_email',$sender->email)
                                        ->orderBy('last_time_message','DESC')
                                        ->get();



        if(!$conversation){
            $conversation = Conversation::create([
                'sender_email' => $sender->email,
                'reciver_email' => $reciver->email,
                'sender_id' => $sender->id,
                'reciver_id' => $reciver->id,
                'sender_type' => 'user',
                'reciver_type' => 'coach',
                'last_time_message' => null,
            ]);
        }
        return view('user.chat.chat',compact('reciver','sender','conversation','conversations','coaches'));
    }


    public function store(Request $request){


        $request->validate([
            //'text ' => ['required'],
            //'sender' => ['required', 'email' , Rule::exists('users','email')],
            'reciver' => ['required', 'email' , Rule::exists('coaches','email')],
            'conversation_id' => ['required', Rule::exists('conversations','id')],
        ]);
        try{
            DB::beginTransaction();
            if ($request->text == null) {
                return redirect()->back();
            }


            $chat = Chat::create([
                'conversation_id' => $request->conversation_id,
                'body' => $request->text,
                'sender_email' => Auth::user()->email,
                'reciver_email' => $request->reciver,
            ]);

            $conversation = Conversation::findOrFail($request->conversation_id);

            $conversation->update([
                'last_time_message' => $chat->created_at,
            ]);

            DB::commit();

            return redirect()->back();

        }catch(Exception $ex){
            DB::rollback();
            return redirect()->back();
        }



    }
}
