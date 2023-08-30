<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function rolepermission(){
        $roles = Role::get();
        return view('admin.role.index',compact('roles'));

    }


    public function create(){

        return view('admin.role.create');
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'permissions' => 'required|array|min:1',
        ]);
        try {

            $role = $this->process(new Role, $request);
            if ($role){
                toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
                return redirect()->back();
            }else{
                toastr()->error('There is a problem', 'Opps', ['timeOut' => 5000]);
                return redirect()->back();
            }

        } catch (\Exception $ex) {
            toastr()->error('There is a problem', 'Opps', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit',compact('role'));
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required|array|min:1',
        ]);
        try {
            $role = Role::findOrFail($id);
            $role = $this->process($role, $request);
            if ($role){
                toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
                return redirect()->back();
            }else{
                toastr()->error('There is a problem', 'Opps', ['timeOut' => 5000]);
                return redirect()->back();
            }

        } catch (\Exception $ex) {
            toastr()->error('There is a problem', 'Opps', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }

    protected function process(Role $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = json_encode($r->permissions);
        $role->save();
        return $role;
    }


    public function delete(Request $request,$id){

        //return $request;
        $role = Role::findOrFail($id);

        $role->delete();

        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();


    }


    public function view($id){
        $role = Role::findOrFail($id);

        $users = $role->admins() ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        return view('admin.role.view',compact('role','users'));
    }
}
