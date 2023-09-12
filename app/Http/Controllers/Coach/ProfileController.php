<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Intervention\Image\Facades\Image as Image;


class ProfileController extends Controller
{
    public function index(){

        $coach = Auth::user();

        return view('coach.profile.index',[
            'coach' => $coach,
        ]);

    }


    public function edit ($id){

        $coach = Coach::findOrFail($id);

        return view('coach.profile.edit',[
            'coach' => $coach,
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
        ]);

    }



    public function update(Request $request){


        $request->validate([
            'fname' => ['required' ,'string' , 'max:255'],
            'lname' => ['required' ,'string' , 'max:255'],
            'birthday' => ['required' ,'date' , 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['required' ,'string' , 'size:2'],
            'city' => ['required' ,'string'],
            //'state' => ['nullable' ,'string'],
            'address' => ['required', 'string', 'min:10', 'max:255'],
            //'locale' => ['required' ,'string' ],
            'postal_code' => ['required' , 'integer' ],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png'],
        ]);


        $coach = $request->user();

        if ($photo = $request->file('avatar')) {
            if(File::exists('images/coach/'.$coach->profile->photo) && $coach->profile->photo) {
                unlink('images/coach/'.$coach->profile->photo);
                $coach->profile->photo = null ;
                $coach->profile->save();
            }
            $file_name = Str::slug($request->fname).".".$photo->getClientOriginalExtension();
            $path = public_path('/images/coach/' .$file_name);
            Image::make($photo->getRealPath())->resize(500,null,function($constraint){
                $constraint->aspectRatio();
            })->save($path,100);

            $input['photo'] =  $file_name;
            //return $input['photo'];
        }

        $input['first_name'] = $request-> fname;
        $input['last_name'] = $request-> lname;
        $input['birthday'] = $request-> birthday;
        $input['gender'] = $request-> gender;
        $input['phone'] = $request-> phone;
        $input['country'] = $request-> country;
        $input['city'] = $request-> city;
        $input['street_address'] = $request->address ;
        $input['postal_code'] = $request-> postal_code;


        $coach->profile->fill($input)->save();

        return redirect()->back()->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success',
        ]);


    }


    public function update_email(Request $request){

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('coaches','email')->ignore(Auth::user()->id)],
        ]);
        $coach = $request->user();
        $coach->update([
            'email' => $request->email,
        ]);

        $coach->email_verified_at = null;
        $coach->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('login');

    }



    public function update_password(Request $request){

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $coach = $request->user();
        $coach->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success',
        ]);

    }


    public function deactivate(Request $request){

        $request->validate([
            'deactivate' => ['required'],
        ]);

        $coach = $request->user();

        Auth::logout();

        $coach->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');

    }




}
