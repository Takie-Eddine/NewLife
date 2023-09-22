<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(){
        $foods = Food::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        return view('user.food.index',compact('foods'));
    }


    public function view($id){
        $food = Food::findOrFail($id);

        return view('user.food.view',compact('food'));
    }
}
