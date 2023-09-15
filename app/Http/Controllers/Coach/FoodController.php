<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(){

        $foods = Food::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->get();

        return view('coach.food.index',compact('foods'));

    }
}
