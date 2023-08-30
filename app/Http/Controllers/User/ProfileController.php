<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Intervention\Image\Facades\Image as Image;

class ProfileController extends Controller
{
    public function index(){

        $user = Auth::user('web');

        return view('user.profile.index',[
            'user' => $user,
        ]);

    }


    public function edit ($id){

        $user = User::findOrFail($id);

        return view('user.profile.edit',[
            'user' => $user,
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


        $user = $request->user();

        if ($photo = $request->file('avatar')) {
            if(File::exists('images/participant/'.$user->profile->photo) && $user->profile->photo) {
                unlink('images/profile/'.$user->profile->photo);
                $user->profile->photo = null ;
                $user->profile->save();
            }
            $file_name = Str::slug($request->fname).".".$photo->getClientOriginalExtension();
            $path = public_path('/images/participant/' .$file_name);
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


        $user->profile->fill($input)->save();

        return redirect()->back()->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success',
        ]);


    }


    public function update_email(Request $request){

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users','email')->ignore(Auth::user('web')->id)],
        ]);
        $user = $request->user();
        $user->update([
            'email' => $request->email,
        ]);

        $user->email_verified_at = null;
        $user->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login');

    }



    public function update_password(Request $request){

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = $request->user();
        $user->update([
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

        $user = $request->user();

        Auth::guard('web')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }



    public function document($id){

        $user = Auth::user('web');
        $medicalinfos = $user->medicalinfos()->latest()->first();
        $files = $user->files()->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();
        return view('user.profile.document',compact('user','medicalinfos','files'));
    }

    public function coach($id){
        $user = Auth::user('web');

        $coaches = $user->coaches()->get();

        return view('user.profile.coach',compact('user','coaches'));

    }




}
