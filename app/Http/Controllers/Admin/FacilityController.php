<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacilityImage;
use App\Models\Touristfacilitie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacilityController extends Controller
{
    public function index(){

        $facilities = Touristfacilitie::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->when(\request()->type != null, function ($query) {
            $query->whereType(\request()->type);
        })->paginate(\request()->limit_by ?? 10);

        return view('admin.facility.index',compact('facilities'));
    }


    public function create(){
        return view('admin.facility.create');
    }


    public function store_image(Request $request){
        $file = $request->file('file');
        $filename = uploadImage($file ,'facility',$request->file->getClientOriginalName());

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    public function store(Request $request){

        //return $request ;
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required','string'],
            'images' => ['required', 'array' ,'min:1' ],
        ]);

        try{

            DB::beginTransaction();
            $facility = Touristfacilitie::create([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
            ]);

            if ($request->has('images') && count($request->images) > 0) {
                foreach ($request->images as $image) {
                    FacilityImage::create([
                        'touristfacilitie_id' => $facility->id,
                        'name' => $image,
                    ]);
                }
            }

            DB::commit();
            toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.facilities');
        }catch(Exception $ex){
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }
    }


    public function view($id){
        $facility = Touristfacilitie::findOrFail($id);

        return view('admin.facility.view',compact('facility'));
    }


    public function edit($id){

        $facility = Touristfacilitie::findOrFail($id);

        return view('admin.facility.edit',compact('facility'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required','string'],
            'images' => ['nullable', 'array' ,'min:1' ],
        ]);
        try{

            DB::beginTransaction();
            $facility = Touristfacilitie::findOrFail($id);

            $facility->update([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
            ]);

            if ($request->has('images') && count($request->images) > 0) {
                foreach ($request->images as $image) {
                    FacilityImage::create([
                        'touristfacilitie_id' => $facility->id,
                        'name' => $image,
                    ]);
                }
            }
            DB::commit();
            toastr()->success('Updated successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.facilities');
        }catch(Exception $ex){
            DB::rollback();
            toastr()->error($ex, 'Oops');
            return redirect()->back();
        }
    }


    public function delete($id){
        $facility = Touristfacilitie::findOrFail($id);

        $facility->images()-> delete();
        Touristfacilitie::destroy($id);
        //UnlinkImage('facility',$facility->name,$facility);

        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();
    }


    public function delete_image($id){
        $image = FacilityImage::findOrFail($id);

        $image->delete();
        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();
    }


}
