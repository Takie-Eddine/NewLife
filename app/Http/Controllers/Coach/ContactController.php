<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){

        $admins = Admin::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })
        ->get();

        return view('coach.contact.index',compact('admins'));
    }


    public function view($id){

        $admin = Admin::findOrFail($id);

        return view('coach.contact.view',compact('admin'));
    }
}
