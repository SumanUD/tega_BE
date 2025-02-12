<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Casestudy;

class CasestudyController extends Controller
{
    public function apiindex(){
        $casestudy = Casestudy::get();
        return response()->json($casestudy);
    }

    public function index(){
        $casestudy = Casestudy::get();
        return view('Admin.addcasestudy',['casestudy'=>$casestudy]);
    }

    // Add casestudy
    public function store(Request $request){
        
    $request->validate([
        'casestudy_title' => 'required',
        'casestudy_description' => 'required | max:255',
        'casestudy_image' => 'required|mimes:jpeg,jpg,png|max:21000'
    ]);


        $imageName = time().'.'.$request->casestudy_image->extension();
        $request->casestudy_image->move(public_path('Assets/Image/casestudy'), $imageName);

        $casestudy = new Casestudy;
        $casestudy->casestudy_image = $imageName;
        $casestudy->casestudy_title = $request->casestudy_title;
        $casestudy->casestudy_description = $request->casestudy_description;

        $casestudy->save();
        return redirect()->back()->with('success', "Case Study added successfully.");

    }

        // Show Casestudy
        public function show_casestudy($slug)
        {
            $casestudy = Casestudy::where('slug',$slug)->first();
    
            if (!$casestudy) {
                return response()->json(['status' => 404, 'error' => 'Casestudy not found'], 404);
            }
    
            return response()->json(['status' => 200, 'casestudy' => $casestudy], 200);
        }

    // Edit Casestudy
    public function edit($slug){

        $casestudy = Casestudy::where('slug',$slug)->first();

        return view('Admin.editcasestudy',compact('casestudy'));

    }

    // Update Casestudy
    public function update(Request $request, $slug){

        $request->validate([
            'casestudy_title' => 'required',
            'casestudy_description' => 'required | max:255',
            'casestudy_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
        ]);

        $casestudy = Casestudy::where('slug', $slug)->first();

        if(isset($request->casestudy_image)){
        $imageName = time().'.'.$request->casestudy_image->extension();
        $request->casestudy_image->move(public_path('Assets/Image/casestudy'), $imageName);
        $casestudy->casestudy_image = $imageName;
        }

        $casestudy->casestudy_title = $request->casestudy_title;
        $casestudy->casestudy_description = $request->casestudy_description;

        $casestudy->save();
        $casestudy = Casestudy::get();
        return redirect()->route('addcasestudy')->with('success', "Case Study updated successfully.");

    }

    // Delete Casestudy
    public function destroy($slug){

        $casestudy = Casestudy::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/casestudy/'.$casestudy->casestudy_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $casestudy->delete();
        return redirect()->route('addcasestudy')->with('success', "Case Study deleted successfully.");
    }
}
