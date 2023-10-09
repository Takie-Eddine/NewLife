<?php

use App\Models\Coach;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Str ;
use Illuminate\Support\Facades\File;

if (!function_exists('uploadImage')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function uploadImage($photo, $folder, $name)
    {
        $file_name = Str::slug($name).".".$photo->getClientOriginalExtension();
            $path = public_path($folder.'/' .$file_name);
            Image::make($photo->getRealPath())->resize(500,null,function($constraint){
                $constraint->aspectRatio();
            })->save($path,100);
            return $file_name;
    }


    function UnlinkImage($folder, $name, $value){
        if(File::exists('images/'.$folder.'/'.$name) && $name) {
            unlink('images/'.$folder.'/'.$name);
            $name = null ;
            $value->save();
        }

    }

    function getUsers(Conversation $conversation){

        if ($conversation->sender_type == 'coach' && $conversation->sender_type == Auth::guard('coach')->check()) {
                $reciverUser = User::find($conversation->reciver_id);

        }else{

                $reciverUser = Coach::find($conversation->reciver_id);
        }

        // if ($conversation->sender_email == Auth::user()->email ) {
        //     $reciverUser = User::firstwhere('email',$conversation->reciver_email);
        // }else{
        //     $reciverUser = Coach::firstwhere('email',$conversation->sender_email);
        // }
        return $reciverUser;

    }



}
