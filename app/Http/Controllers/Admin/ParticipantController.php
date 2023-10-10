<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Program;
use App\Models\User;
use App\Models\UserMedicalInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ParticipantController extends Controller
{
    public function index(){

        $participants = User::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->paginate(\request()->limit_by ?? 10);



        return view('admin.participant.index', compact('participants'));

    }


    public function create(){

        $programs = Program::select('id','name')->get();
        $plans = Plan::select('id','name')->get();
        return view('admin.participant.create',[
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
            'programs' => $programs,
            'plans' => $plans,
        ]);
    }

    public function getplans($id){

        $plans = Plan::where('program_id', $id)->pluck("name","id");
        return $plans;
    }



    public function store(Request $request){

        //return $request;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' =>  ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' =>  ['required','regex:/^([0-9\s\-\+\(\)]*)$/', Rule::unique('user_profiles','phone')],
            'password' => ['required','string', 'min:8'],
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
            'weight' => ['nullable', 'numeric','between:0,999.99'],
            'height' => ['nullable', 'numeric','between:0,999.99'],
            'blood_type' => ['nullable', 'in:A+,A-,B+,B-,AB+,AB-,O+;O-'],
            'sugar' => ['nullable', 'numeric','between:0,999.99'],
            'tension' => ['nullable'],
            'oxygen' => ['nullable', 'numeric'],
            'sleep_hour' => ['nullable', 'numeric','between:0,999.59'],
            'program' => ['required', Rule::exists('programs','id')],
            'plan' => ['required', Rule::exists('plans','id')],
        ]);

        try {
            DB::beginTransaction();
            $participant = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'program_id'=> $request->program,
                'plan_id'=> $request->plan,
            ]);

            if ($photo = $request->file('avatar')) {
                $file_name = uploadImage($photo, 'participant', $request->name);
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

            $participant->profile->fill($input)->save();

            UserMedicalInfo::create([
                'user_id' => $participant->id,
                'weight' => $request-> weight,
                'height' => $request-> height,
                'blood_type' => $request-> blood_type,
                'sugar' => $request-> sugar,
                'tension' => $request-> tension,
                'oxygene' => $request-> oxygen,
                'sleep_hours' => $request-> sleep_hour,
            ]);

            event(new Registered($participant));

            DB::commit();
            toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.participants');

        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }


    }


    public function view($id){
        $participant = User::findOrFail($id);
        $medicalinfos = $participant->medicalinfos()->latest()->first();
        return view('admin.participant.view',compact('participant','medicalinfos'));
    }



    public function edit($id){

        $participant = User::findOrFail($id);
        $medical_info = $participant->medicalinfos()->first();
        //return $medical_info ;
        $programs = Program::select('id','name')->get();
        $plans = Plan::select('id','name')->where('program_id',$participant->program_id)->get();
        if ($plans->count()==0) {
            $plans = Plan::select('id','name')->get();
        }
        return view('admin.participant.edit',[
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
            'programs' => $programs,
            'participant' => $participant,
            'medical_info' => $medical_info,
            'plans' => $plans,
        ]);
    }



    public function update(Request $request, $id){



        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' =>  ['required', 'string', 'email', 'max:255', Rule::unique('users','email')->ignore($id)],
            'phone' =>  ['required','regex:/^([0-9\s\-\+\(\)]*)$/', Rule::unique('user_profiles','phone')->ignore($id,'user_id')],
            'password' => ['nullable','string', 'min:8'],
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
            'weight' => ['nullable', 'numeric','between:0,999.99'],
            'height' => ['nullable', 'numeric','between:0,999.99'],
            'blood_type' => ['nullable', 'in:A+,A-,B+,B-,AB+,AB-,O+;O-'],
            'sugar' => ['nullable', 'numeric','between:0,999.99'],
            'tension' => ['nullable'],
            'oxygen' => ['nullable', 'numeric'],
            'sleep_hour' => ['nullable', 'numeric','between:0,999.59'],
            'program' => ['required', Rule::exists('programs','id')],
            'plan' => ['required', Rule::exists('plans','id')],
        ]);

        try{

            DB::beginTransaction();

            $participant = User::findOrFail($id);

            if ($request->password) {
                $participant->update([
                    'password' => $request->password ,
                ]);
            }

            if ($request-> email == $participant->email) {
                $participant->update([
                'name' => $request->name,
                'email' => $request->email,
                'program_id'=> $request->program,
                'plan_id'=> $request->plan,
                ]);
            } else {
                $participant->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'program_id'=> $request->program,
                    'plan_id'=> $request->plan,
                    ]);
                    event(new Registered($participant));
            }

            if ($photo = $request->file('avatar')) {
                UnlinkImage('participant',$participant->photo,$participant);
                $file_name = uploadImage($photo, 'profile', $request->name);
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

            $participant->profile->fill($input)->save();

            $participant->medicalinfos()->updateOrCreate([
                'weight' => $request-> weight,
                'height' => $request-> height,
                'blood_type' => $request-> blood_type,
                'sugar' => $request-> sugar,
                'tension' => $request-> tension,
                'oxygene' => $request-> oxygen,
                'sleep_hours' => $request-> sleep_hour,
            ]);

            DB::commit();
            toastr()->success('Updated successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.participants');

        }catch(Exception $ex){
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }

    }



    public function delete($id){
        $participant = User::findOrFail($id);

        User::destroy($id);

        //UnlinkImage('participant',$participant->profile->photo,$participant);

        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();

    }



    public function active($id){

        $participant = User::findOrFail($id);

        if ($participant->status == 'active') {
            $participant->update([
                'status' => 'inactive',
            ]);
        } else {
            $participant->update([
                'status' => 'active',
            ]);
        }

        toastr()->success('Changed successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->back();

    }



    public function document($id){

        $participant = User::findOrFail($id);
        $medicalinfos = $participant->medicalinfos()->latest()->first();
        $files = $participant->files()->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();
        return view('admin.participant.document',compact('participant','medicalinfos','files'));
    }

    public function coach($id){
        $participant = User::findOrFail($id);

        $coaches = $participant->coaches()->get();

        return view('admin.participant.coach',compact('participant','coaches'));

    }

}
