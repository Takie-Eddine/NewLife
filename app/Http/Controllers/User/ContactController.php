<?php

namespace App\Http\Controllers\User;

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

        return view('user.contact.index',compact('admins'));
    }


    public function view($id){

        $admin = Admin::findOrFail($id);

        return view('user.contact.view',compact('admin'));
    }
}
