<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Meal;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function index(){

        $foods = Food::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        return view('admin.food.index',compact('foods'));
    }



    public function create(){

        return view('admin.food.create');
    }


    public function store(Request $request){



        $request->validate([
            'date' => ['required', 'date', 'after:today'],
            'foods.*.type' => ['required','in:breakfast,lunch,dinner'],
            'foods.*.meals.*.name' => ['required','string'],
            'foods.*.meals.*.description' => ['required'],
            'foods.*.meals.*.image' => ['nullable','mimes:jpg,jpeg,png'],
        ]);

        try{
            DB::beginTransaction();
            $meal = Food::create([
                'date' => $request->date,

            ]);
            foreach ($request->foods as $food => $value) {

                $type= Type::create([
                    'food_id' => $meal->id,
                    'type' => $value['type'],
                ]);

                foreach ($value['meals'] as $item => $key) {
                    $file_name = null ;
                    if ( isset($key['image'])) {
                        $photo =  $key['image'] ;
                            $file_name = uploadImage($photo, 'food', $key['name']);
                        }
                    Meal::create([
                        'food_id' => $meal->id,
                        'type_id' => $type->id,
                        'name' => $key['name'],
                        'description' => $key['description'],
                        'photo' => $file_name,
                    ]);
                }
            }
            DB::commit();
            toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.foods');

        }catch(Exception $ex){

            DB::rollback();

            return $ex;

        }

    }



    public function edit($id){

        $food = Food::findOrFail($id);

        return view('admin.food.edit',compact(('food')));
    }


    public function update(Request $request, $id){

        //return $request ;
        $request->validate([
            'date' => ['required', 'date', 'after:today'],
            'foods.*.type' => ['required','in:breakfast,lunch,dinner'],
            'foods.*.meals.*.name' => ['required','string'],
            'foods.*.meals.*.description' => ['required'],
            'foods.*.meals.*.image' => ['nullable','mimes:jpg,jpeg,png'],
        ]);

        try{
            $meal = Food::findOrFail($id);
            DB::beginTransaction();

            $meal->update([
                'date' => $request->date,

            ]);

            foreach ($meal->types as $type) {
                $type->delete();
                $type->meals()->delete();
            }

            foreach ($request->foods as $food => $value) {

                $type= Type::create([
                    'food_id' => $meal->id,
                    'type' => $value['type'],
                ]);

                foreach ($value['meals'] as $item => $key) {
                    $file_name = null;
                    if (isset($key['image'])) {
                        $photo = $key['image'];
                        $file_name = uploadImage($photo, 'food', $key['name']);
                        Meal::create([
                            'food_id' => $meal->id,
                            'type_id' => $type->id,
                            'name' => $key['name'],
                            'description' => $key['description'],
                            'photo' => $file_name,
                        ]);
                    }
                    Meal::create([
                        'food_id' => $meal->id,
                        'type_id' => $type->id,
                        'name' => $key['name'],
                        'description' => $key['description'],
                    ]);
                }
            }
            DB::commit();
            toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
            return redirect()->route('admin.foods');

        }catch(Exception $ex){
            DB::rollback();
            return $ex ;
        }



    }


    public function delete($id){

        $food = Food::findOrFail($id);

        $food->delete();

        UnlinkImage('food',$food->photo,$food);

        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();

    }



    public function view($id){
        $food = Food::findOrFail($id);

        return view('admin.food.view',compact('food'));

    }
}
