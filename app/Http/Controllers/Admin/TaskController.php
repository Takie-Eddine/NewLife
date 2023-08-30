<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })->paginate(\request()->limit_by ?? 10);

        return view('admin.task.index',compact('tasks'));
    }


    public function create(){
        $admins = Admin::all();
        return view('admin.task.create',compact('admins'));
    }


    public function store(Request $request){

        $request->validate([
            'name' => ['required','string'],
            'description' => ['nullable'],
            'admin' => ['required',Rule::exists('admins','id')],
        ]);


        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'admin_id' => $request->admin,
            'status' => 'Pending',
        ]);
        toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->route('admin.tasks');
    }


    public function edit($id){
        $task = Task::FindOrFail($id);
        $admins = Admin::all();

        return view('admin.task.edit',compact('admins','task'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => ['required','string'],
            'description' => ['nullable'],
            'admin' => ['required',Rule::exists('admins','id')],
            'status' => ['required', 'in:Pending,In Progress,Completed']
        ]);

        $task = Task::FindOrFail($id);
        $task ->update([
            'name' => $request->name,
            'description' => $request->description,
            'admin_id' => $request->admin,
            'status' => $request->status,
        ]);
        toastr()->success('Updated successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->route('admin.tasks');
    }



    public function delete($id){
        $task = Task::FindOrFail($id);

        $task->delete();
        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();
    }
}
