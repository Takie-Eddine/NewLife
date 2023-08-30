<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanService;
use App\Models\Program;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PlanController extends Controller
{
    public function index(){

        $plans = Plan::with(['services', 'program'])
        ->when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        return view('admin.plan.index',compact('plans'));
    }



    public function create(){

        $programs = Program::select('id','name')->get();
        $services = Service::select('id','description')->get();

        return view('admin.plan.create',compact('programs','services'));
    }



    public function store(Request $request){

        //return $request ;
        $request->validate([
            'name' => ['required', 'string' , 'min:4'],
            'description' => ['nullable', 'string' , 'min:4'],
            'program' => ['required', Rule::exists('programs','id')],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png'],
            'services' => [
                '*.service'=> ['required' ,Rule::exists('services','id')],
                '*.description'=> ['nullable', 'string'],
                ]
        ]);

        try{
            DB::beginTransaction();
            if ($photo = $request->file('avatar')) {
                $file_name = uploadImage($photo, 'plan', $request->name);
            }

            $plan = Plan::create([
                'program_id'=> $request->program,
                'name'=> $request->name,
                'is_active' => 'active',
                'photo' => $file_name
            ]);

            foreach ($request->services as $key => $value) {
                $item = null;
                if ($value['included'] ) {
                    $item = 'checked';
                }

                $plan_services = PlanService::create([
                    'plan_id' => $plan->id,
                    'service_id' => $value['service'],
                    'description' => $value['description'],
                    'is_checked' => $item,
                ]);
            }
            DB::commit();
            toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.plans');
        }catch(Exception $ex){
            DB::rollBack();
            toastr()->error($ex, 'Oops');
            return redirect()->back();

        }
    }


    public function view($id){

        $plan = Plan::findOrFail($id);

        //return $plan->services;

        return view('admin.plan.view',compact('plan'));
    }


    public function edit($id){

        $plan = Plan::findOrfail($id);
        $programs = Program::select('id','name')->get();
        $services = Service::select('id','description')->get();
        $plan_services =  PlanService::where('plan_id', '=', $plan->id)->get();
        //return $plan_services ;
        return view('admin.plan.edit',compact('plan', 'programs', 'services', 'plan_services'));

    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string' , 'min:4'],
            'description' => ['nullable', 'string' , 'min:4'],
            'program' => ['required', Rule::exists('programs','id')],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png'],
            'services' => [
                '*.service'=> ['required' ,Rule::exists('services','id')],
                '*.description'=> ['nullable', 'string'],
                ]
        ]);
        try {
            DB::beginTransaction();

            $plan = Plan::FindOrFail($id);

            if ($photo = $request->file('avatar')) {

                UnlinkImage('plan',$plan->photo,$plan);
                $file_name = uploadImage($photo, 'plan', $request->name);
                $plan->update([
                    'photo' => $file_name,
                ]);
            }

            $plan->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $services = PlanService::where('plan_id', '=', $plan->id)->get();

            foreach ($services as $service) {
                $service->delete();
            }
            foreach ($request->services as $key => $value) {
                $item = null;
                if ($value['included'] ) {
                    $item = 'checked';
                }

                $plan_services = PlanService::create([
                    'plan_id' => $plan->id,
                    'service_id' => $value['service'],
                    'description' => $value['description'],
                    'is_checked' => $item,
                ]);
            }
            DB::commit();
            toastr()->success('Updated successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.plans');

        } catch (Exception $ex) {

            DB::rollBack();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }
    }


    public function delete($id){

        $plan = Plan::findOrfail($id);

        try {
            DB::beginTransaction();

            $services = PlanService::where('plan_id', '=', $plan->id)->get();

            foreach ($services as $service) {
                $service->delete();
            }

            Plan::destroy($id);

            UnlinkImage('plan',$plan->photo,$plan);

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
        $plan = Plan::findOrFail($id);

        if ($plan->is_active == 'active') {
            $plan->update([
                'is_active' => 'inactive',
            ]);
        } else {
            $plan->update([
                'is_active' => 'active',
            ]);
        }

        toastr()->success('Changed successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->back();

    }



}
