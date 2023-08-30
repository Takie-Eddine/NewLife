<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Program;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class CoachController extends Controller
{
    public function index(){

        $coaches = Coach::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->paginate(\request()->limit_by ?? 10);
        return view('admin.coach.index', compact('coaches'));

    }


    public function create(){

        $participants = User::select('id','name')->whereStatus('active')->get();

        return view('admin.coach.create',[
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
            'participants' => $participants,
        ]);
    }

    public function store(Request $request){

        //return $request;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' =>  ['required', 'string', 'email', 'max:255', 'unique:'.Coach::class],
            'password' => ['required','string', 'min:8'],
            'type' => ['nullable' ,'string' , 'max:255'],
            'fname' => ['nullable' ,'string' , 'max:255'],
            'lname' => ['nullable' ,'string' , 'max:255'],
            'birthday' => ['nullable' ,'date' , 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['nullable' ,'string' , 'size:2'],
            'city' => ['nullable' ,'string'],
            //'state' => ['nullable' ,'string'],
            'address' => ['nullable', 'string', 'min:10', 'max:255'],
            //'locale' => ['required' ,'string' ],
            'postal_code' => ['nullable' , 'integer' ],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png'],
            'participants' => ['required', Rule::exists('users','id')],
        ]);

        try {
            DB::beginTransaction();
            $coach = Coach::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type'=> $request->type,
                'email_verified_at' => Carbon::now(),
                'status'=> 'active',
            ]);

            if ($photo = $request->file('avatar')) {
                $file_name = uploadImage($photo, 'coach', $request->name);
                $input['photo'] =  $file_name;
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

            $coach->participants()->sync($request->participants);


            DB::commit();
            toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.coaches');

        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }


    }


    public function view($id){
        $coach = Coach::findOrFail($id);
        return view('admin.coach.view',compact('coach'));
    }



    public function edit($id){

        $coach = Coach::findOrFail($id);
        $participants = User::select('id','name')->whereStatus('active')->get();
        return view('admin.coach.edit',[
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
            'coach' => $coach,
            'participants' => $participants,
        ]);
    }



    public function update(Request $request, $id){


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' =>  ['required', 'string', 'email', 'max:255', Rule::unique('coaches','email')->ignore($id)],
            'password' => ['nullable','string', 'min:8'],
            'type' => ['nullable' ,'string' , 'max:255'],
            'fname' => ['nullable' ,'string' , 'max:255'],
            'lname' => ['nullable' ,'string' , 'max:255'],
            'birthday' => ['nullable' ,'date' , 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['nullable' ,'string' , 'size:2'],
            'city' => ['nullable' ,'string'],
            //'state' => ['nullable' ,'string'],
            'address' => ['nullable', 'string', 'min:10', 'max:255'],
            //'locale' => ['required' ,'string' ],
            'postal_code' => ['nullable' , 'integer' ],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png'],
            'participants' => ['required', Rule::exists('users','id')],
        ]);

        try{

            DB::beginTransaction();

            $coach = Coach::findOrFail($id);

            if ($request->password) {
                $coach->update([
                    'password' => $request->password ,
                ]);
            }

                $coach->update([
                'name' => $request->name,
                'email' => $request->email,
                'type'=> $request->type,

                ]);

            if ($photo = $request->file('avatar')) {
                UnlinkImage('coach',$coach->photo,$coach);
                $file_name = uploadImage($photo, 'coach', $request->name);
                $input['photo'] =  $file_name;
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

            $coach->participants()->sync($request->participants);
            DB::commit();
            toastr()->success('Updated successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.coaches');

        }catch(Exception $ex){
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }

    }




    public function delete($id){
        $coach = Coach::findOrFail($id);

        Coach::destroy($id);


        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();

    }



    public function active($id){

        $coach = Coach::findOrFail($id);

        if ($coach->status == 'active') {
            $coach->update([
                'status' => 'inactive',
            ]);
        } else {
            $coach->update([
                'status' => 'active',
            ]);
        }

        toastr()->success('Changed successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->back();

    }


    public function participant($id){
        $coach = Coach::findOrFail($id);

        $participants = $coach->participants()->get();

        return view('admin.coach.participant',compact('participants','coach'));

    }




}
