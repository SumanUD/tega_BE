<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industry;

class IndustryController extends Controller
{
    public function apiindex(){
        $industrys = Industry::get();
        return response()->json($industrys);
    }

    public function index(){
        $industrys = Industry::get();
        return view('Admin.addindustry',['industry'=>$industrys]);
    }

    // Add industry
    public function store(Request $request){
        
    $request->validate([
        'industry_name' => 'required',
        'industry_image' => 'required|mimes:jpeg,jpg,png|max:21000'
    ]);


        $imageName = time().'.'.$request->industry_image->extension();
        $request->industry_image->move(public_path('Assets/Image/industry'), $imageName);

        $industry = new Industry;
        $industry->industry_image = $imageName;
        $industry->industry_name = $request->industry_name;

        $industry->save();
        return redirect()->back()->with('success', "Industry added successfully.");

    }

    // Edit Industry
    public function edit($slug){

        $industry = Industry::where('slug',$slug)->first();

        return view('Admin.editindustry',compact('industry'));

    }

    // Update Industry
    public function update(Request $request, $slug){

        $request->validate([
            'industry_name' => 'required',
            'industry_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
        ]);

        $industry = Industry::where('slug', $slug)->first();

        if(isset($request->industry_image)){
        $imageName = time().'.'.$request->industry_image->extension();
        $request->industry_image->move(public_path('Assets/Image/industry'), $imageName);
        $industry->industry_image = $imageName;
        }

        $industry->industry_name = $request->industry_name;

        $industry->save();
        $industrys = Industry::get();
        return redirect()->route('addindustry')->with('success', "Industry updated successfully.");

    }

    // Delete Industry
    public function destroy($slug){

        $industry = Industry::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/industry/'.$industry->industry_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $industry->delete();
        return redirect()->route('addindustry')->with('error', "Industry Deleted successfully.");
    }
}
