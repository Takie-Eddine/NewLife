<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class UserController extends Controller
{
    public function index(){

        $admins = Admin::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();
        return view('admin.user.index', compact('admins'));

    }



    public function create(){

        $roles = Role::select('id','name')->get();
        return view('admin.user.create',[
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
            'roles' => $roles,
        ]);

    }




    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' =>  ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
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
            'role' => ['required', Rule::exists('roles','id')],
        ]);

        try {
            DB::beginTransaction();
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id'=> $request->role,
                'email_verified_at' => Carbon::now(),
            ]);

            if ($photo = $request->file('avatar')) {
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

            $admin->profile->fill($input)->save();


            DB::commit();
            toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.users');

        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }



    }




    public function edit($id){

        $admin = Admin::findOrFail($id);
        $roles = Role::select('id','name')->get();
        $countries = Countries::getNames();
        return view('admin.user.edit',compact('admin','roles','countries'));
    }




    public function update(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' =>  ['required', 'string', 'email', 'max:255', Rule::unique('admins','email')->ignore($id)],
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
            'role' => ['required', Rule::exists('roles','id')],
        ]);

        try{

            DB::beginTransaction();

            $admin = Admin::findOrFail($id);

            if ($request->password) {
                $admin->update([
                    'password' => $request->password ,
                ]);
            }

                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id'=> $request->role,

                    ]);

            if ($photo = $request->file('avatar')) {
                UnlinkImage('profile',$admin->photo,$admin);
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

            $admin->profile->fill($input)->save();


            DB::commit();
            toastr()->success('Updated successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.users');

        }catch(Exception $ex){
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }


    }



    public function delete($id){
        $admin = Admin::findOrFail($id);

        Admin::destroy($id);


        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();

    }


    public function view($id){
        $admin = Admin::findOrFail($id);

        return view('admin.user.view',compact('admin'));
    }




    public function status(Request $request, $id){

        $request->validate([
            'status' => ['required', 'in:Pending,In Progress,Completed'],
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'status' => $request->status,
        ]);

        toastr()->success('Updated successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->back();



    }
}
