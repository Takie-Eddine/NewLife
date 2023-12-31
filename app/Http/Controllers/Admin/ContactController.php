<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){

        $admins = Admin::when(request()->keyword != null,function ($query){
            $query->search(request()->keyword);
        })
        ->get();

        return view('admin.contact.index',compact('admins'));
    }



    public function view($id){

        $admin = Admin::findOrFail($id);

        return view('admin.contact.view',compact('admin'));
    }
}
