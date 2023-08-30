<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Program;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function index(){

        $programs = Program::with(['plans', 'features'])
                    ->when(request()->keyword != null,function ($query){
                        $query->search(request()->keyword);
                    })
                    ->get();

        return view('admin.program.index',compact('programs'));
    }



    public function create(){

        return view('admin.program.create');
    }



    public function store(Request $request){



        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'string', 'min:5'],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png'],
            'features' => [
                            '*.feature'=> ['nullable','string'],
                            '*.services'=> [
                                            '*.service' => ['nullable','string'],
                                            ],
                            ]
        ]);

        try{

            DB::beginTransaction();

            if ($photo = $request->file('avatar')) {
                $file_name = uploadImage($photo, 'program', $request->name);
            }


            $program = Program::create([
                'name' => $request->name,
                'description' => $request->description,
                'photo' => $file_name,
                'is_active' => 'active',
            ]);

            foreach ($request->features as $feature => $value ) {
                $feature = Feature::create([
                    'program_id' => $program->id,
                    'name' =>  $value['feature'],
                    'is_active' => 'active',
                ]);

                foreach ($value['services'] as $service => $item) {
                    $service = Service::create([
                        'feature_id' => $feature->id,
                        'description' => $item['service'],
                        'is_active' => 'active',
                    ]);
                }

            }
            DB::commit();
            toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.programs');

        }catch(Exception $ex){
            DB::rollBack();
            toastr()->error($ex, 'Oops');
            return redirect()->back();

        }
    }


    public function view($id){

        $program = Program::findOrFail($id);

        return view('admin.program.view',compact('program'));

    }


    public function edit($id){
        $program = Program::findOrFail($id);
        return view('admin.program.edit',compact('program'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'string', 'min:5'],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png'],
            'features' => [
                            '*.feature'=> ['nullable','string'],
                            '*.services'=> [
                                            '*.service' => ['nullable','string'],
                                            ],
                            ]
        ]);

        try{
            $program = Program::findOrFail($id);
            DB::beginTransaction();

            if ($photo = $request->file('avatar')) {

                UnlinkImage('program',$program->photo,$program);

                $file_name = uploadImage($photo, 'program', $request->name);

                $program ->update([
                    'photo'=> $file_name ,
                ]);
            }

            $program->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            foreach ($program->features as $feature) {
                $feature->services()->delete();
            }

            $program->features()->delete();

            foreach ($request->features as $feature => $value ) {
                $feature = Feature::create([
                    'program_id' => $program->id,
                    'name' =>  $value['feature'],
                    'is_active' => 'active',
                ]);

                foreach ($value['services'] as $service => $item) {
                    $service = Service::create([
                        'feature_id' => $feature->id,
                        'description' => $item['service'],
                        'is_active' => 'active',
                    ]);
                }
            }

            DB::commit();

            toastr()->success('Updated successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.programs');

        }catch(Exception $ex){
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }

    }



    public function delete($id){

        $program = Program::findOrfail($id);


        try {
            DB::beginTransaction();

            foreach ($program->features as $feature) {
                $feature->services()->delete();
            }

            $program->features()->delete();

            Program::destroy($id);

            UnlinkImage('program',$program->photo,$program);

            DB::commit();

            toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

            return redirect()->back();

        }catch (Exception $ex){
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }



    }


    public function active($id){

        $program = Program::findOrFail($id);

        if ($program->is_active == 'active') {
            $program->update([
                'is_active' => 'inactive',
            ]);
        } else {
            $program->update([
                'is_active' => 'active',
            ]);
        }

        toastr()->success('Changed successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->back();

    }


}
