<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Touristfacilitie;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index(){
        $facilities = Touristfacilitie::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })->when(\request()->type != null, function ($query) {
            $query->whereType(\request()->type);
        })->paginate(\request()->limit_by ?? 10);

        return view('coach.facility.index',compact('facilities'));

    }


    public function view($id){
        $facility = Touristfacilitie::findOrFail($id);

        return view('coach.facility.view',compact('facility'));
    }
}
