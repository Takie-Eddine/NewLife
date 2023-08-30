<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dossier;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function index(){

        $files = File::when(request()->keyword != null,function ($query){
                        $query->search(request()->keyword);
                    })
                    ->get();
        return view('admin.report.index',compact('files'));
    }



    public function create(){
        $participants = User::where('status','=','active')->get();
        return view('admin.report.upload',compact('participants'));
    }



    public function store(Request $request){

        $request->validate([
            'file' => ['required','mimes:doc,docx,pdf,xls,xlsx,csv,tsv,ppt,pptx,pages,odt,rtf'],
            'participant' => ['required',Rule::exists('users','id')],
        ]);

        $participant = User::findOrFail($request->participant);



        if ($file =  $request->file('file')) {
            $file_name = $participant->name.'-'.$file->getClientOriginalName();
            $file->move(public_path('images/files/'),$file_name);
        }

        $file = File::create([
            'user_id' => $request->participant,
            'name'=> $file_name,
        ]);


        toastr()->success('Created successfully!', 'Congrats', ['timeOut' => 5000]);
        return redirect()->back();
    }



    public function delete($id){

        $file = File::findOrFail($id);

        $file->delete();

        toastr()->success('Deleted successfully!', 'Congrats', ['timeOut' => 5000]);

        return redirect()->back();
    }


    public function download($id){

        $file = File::findOrFail($id);

        return response()->download(public_path('images/files/'.$file->name));
    }



}
