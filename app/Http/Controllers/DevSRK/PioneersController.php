<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pioneers;

class PioneersController extends Controller
{
    public function apiindex(){
        $pioneers = Pioneers::get();
        return response()->json($pioneers);
    }

    public function index(){
        $pioneers = Pioneers::get();
        return view('Admin.addpioneers',['pioneers'=>$pioneers]);
    }

    // Add pioneers
    public function store(Request $request){
        
    $request->validate([
        'pioneers_name' => 'required',
        'pioneers_designation' => 'required',
        'pioneers_image' => 'required|mimes:jpeg,jpg,png|max:21000'
    ]);


        $imageName = time().'.'.$request->pioneers_image->extension();
        $request->pioneers_image->move(public_path('Assets/Image/pioneers'), $imageName);

        $pioneers = new Pioneers;
        $pioneers->pioneers_image = $imageName;
        $pioneers->pioneers_name = $request->pioneers_name;
        $pioneers->pioneers_designation = $request->pioneers_designation;
        $pioneers->twitter = $request->twitter;
        $pioneers->linkedin = $request->linkedin;
        $pioneers->facebook = $request->facebook;
        $pioneers->mail = $request->mail;

        $pioneers->save();
        return redirect()->back()->with('success', "Pioneers added successfully.");

    }

    // Edit Pioneers
    public function edit($slug){

        $pioneers = Pioneers::where('slug',$slug)->first();

        return view('Admin.editpioneers',compact('pioneers'));

    }

    // Update Pioneers
    public function update(Request $request, $slug){

        $request->validate([
            'pioneers_name' => 'required',
            'pioneers_designation' => 'required',
            'pioneers_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
        ]);

        $pioneers = Pioneers::where('slug', $slug)->first();

        if(isset($request->pioneers_image)){
        $imageName = time().'.'.$request->pioneers_image->extension();
        $request->pioneers_image->move(public_path('Assets/Image/pioneers'), $imageName);
        $pioneers->pioneers_image = $imageName;
        }

        $pioneers->pioneers_name = $request->pioneers_name;
        $pioneers->pioneers_designation = $request->pioneers_designation;
        $pioneers->twitter = $request->twitter;
        $pioneers->linkedin = $request->linkedin;
        $pioneers->facebook = $request->facebook;
        $pioneers->mail = $request->mail;

        $pioneers->save();
        $pioneers = Pioneers::get();
        return redirect()->route('addpioneers')->with('success', "Pioneers updated successfully.");

    }

    // Delete Pioneers
    public function destroy($slug){

        $pioneers = Pioneers::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/pioneers/'.$pioneers->pioneers_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $pioneers->delete();
        return redirect()->route('addpioneers')->with('Error', "Pioneers Deleted successfully.");
    }
}
