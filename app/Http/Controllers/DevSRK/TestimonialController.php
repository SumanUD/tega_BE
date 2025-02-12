<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function apiindex(){
        $testimonials = Testimonial::get();
        return response()->json($testimonials);
    }

    public function index(){
        $testimonials = Testimonial::get();
        return view('Admin.addtestimonial',['testimonial'=>$testimonials]);
    }

    // Add testimonial
    public function store(Request $request){
        
    $request->validate([
        'testimonial_name' => 'required',
        'testimonial_description' => 'required | max:255',
        'testimonial_designation' => 'required',
        'testimonial_image' => 'required|mimes:jpeg,jpg,png|max:5000|dimensions:max_width=80,max_height=80'
    ]);


        $imageName = time().'.'.$request->testimonial_image->extension();
        $request->testimonial_image->move(public_path('Assets/Image/testimonial'), $imageName);

        $testimonial = new Testimonial;
        $testimonial->testimonial_image = $imageName;
        $testimonial->testimonial_name = $request->testimonial_name;
        $testimonial->testimonial_designation = $request->testimonial_designation;
        $testimonial->testimonial_description = $request->testimonial_description;

        $testimonial->save();
        return redirect()->back()->with('success', "Testimonial added successfully.");

    }

    // Edit Testimonial
    public function edit($slug){

        $testimonial = Testimonial::where('slug',$slug)->first();

        return view('Admin.edittestimonial',compact('testimonial'));

    }

    // Update Testimonial
    public function update(Request $request, $slug){

        $request->validate([
            'testimonial_name' => 'required',
            'testimonial_description' => 'required | max:255',
            'testimonial_designation' => 'required',
            'testimonial_image' => 'nullable|mimes:jpeg,jpg,png|max:5000|dimensions:max_width=80,max_height=80'
        ]);

        $testimonial = Testimonial::where('slug', $slug)->first();

        if(isset($request->testimonial_image)){
        $imageName = time().'.'.$request->testimonial_image->extension();
        $request->testimonial_image->move(public_path('Assets/Image/testimonial'), $imageName);
        $testimonial->testimonial_image = $imageName;
        }

        $testimonial->testimonial_name = $request->testimonial_name;
        $testimonial->testimonial_description = $request->testimonial_description;
        $testimonial->testimonial_designation = $request->testimonial_designation;

        $testimonial->save();
        $testimonials = Testimonial::get();
        return redirect()->route('addtestimonial')->with('success', "Testimonial updated successfully.");

    }

    // Delete Testimonial
    public function destroy($slug){

        $testimonial = Testimonial::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/testimonial/'.$testimonial->testimonial_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $testimonial->delete();
        return redirect()->route('addtestimonial')->with('Error', "Testimonial Deleted successfully.");
    }
}
