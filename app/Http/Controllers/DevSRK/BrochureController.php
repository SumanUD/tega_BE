<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brochure;

class BrochureController extends Controller
{
    public function apiindex(){
        $brochure = Brochure::get();
        return response()->json($brochure);
    }

    public function index(){
        $brochure = Brochure::get();
        return view('Admin.addbrochure',['brochure'=>$brochure]);
    }

    // Add brochure
    public function store(Request $request){
        
    $request->validate([
        'brochure_title' => 'required',
        'brochure_file' => 'required|mimes:pdf,doc,docx|max:5000'
    ]);


        $fileName = $request->brochure_title.'.'.$request->brochure_file->extension();
        $request->brochure_file->move(public_path('Assets/File/brochure'), $fileName);

        $brochure = new Brochure;
        $brochure->brochure_file = $fileName;
        $brochure->brochure_title = $request->brochure_title;

        $brochure->save();
        return redirect()->back()->with('success', "Brochure added successfully.");

    }

    // Edit Brochure
    public function edit($slug){

        $brochure = Brochure::where('slug',$slug)->first();

        return view('Admin.editbrochure',compact('brochure'));

    }

    // Update Brochure
    public function update(Request $request, $slug){

        $request->validate([
            'brochure_title' => 'required',
            'brochure_file' => 'nullable|mimes:pdf,doc,docx|max:5000'
        ]);

        $brochure = Brochure::where('slug', $slug)->first();

        $file_path = public_path('Assets/File/brochure/'.$brochure->brochure_file);
        if(file_exists($file_path)){
            unlink($file_path);
        }

        if(isset($request->brochure_file)){
        $fileName = $request->brochure_title.'.'.$request->brochure_file->extension();
        $request->brochure_file->move(public_path('Assets/File/brochure'), $fileName);
        $brochure->brochure_file = $fileName;
        }

        $brochure->brochure_title = $request->brochure_title;

        $brochure->save();
        $brochure = Brochure::get();
        return redirect()->route('addbrochure')->with('success', "Brochure updated successfully.");

    }

    // Delete Brochure
    public function destroy($slug){

        $brochure = Brochure::where('slug',$slug)->first();
        $file_path = public_path('Assets/File/brochure/'.$brochure->brochure_file);
        if(file_exists($file_path)){
            unlink($file_path);
        }
        $brochure->delete();
        return redirect()->route('addbrochure')->with('error', "Brochure deleted successfully.");
    }
}
