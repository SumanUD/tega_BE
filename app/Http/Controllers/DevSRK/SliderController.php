<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function apiindex(){
        $slider = Slider::get();
        return response()->json($slider);
    }

    public function index(){
        $slider = Slider::get();
        return view('Admin.addslider',['slider'=>$slider]);
    }

    // Add slider
    public function store(Request $request){
        
    $request->validate([
        'slider_title' => 'required',
        'slider_description' => 'required | max:255',
        'slider_image' => 'required|mimes:jpeg,jpg,png|max:21000'
    ]);


        $imageName = time().'.'.$request->slider_image->extension();
        $request->slider_image->move(public_path('Assets/Image/slider'), $imageName);

        $slider = new Slider;
        $slider->slider_image = $imageName;
        $slider->slider_title = $request->slider_title;
        $slider->slider_description = $request->slider_description;

        $slider->save();
        return redirect()->back()->with('success', "Slider added successfully.");

    }

    // Edit Slider
    public function edit($slug){

        $slider = Slider::where('slug',$slug)->first();

        return view('Admin.editslider',compact('slider'));

    }

    // Update Slider
    public function update(Request $request, $slug){

        $request->validate([
            'slider_title' => 'required',
            'slider_description' => 'required | max:255',
            'slider_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
        ]);

        $slider = Slider::where('slug', $slug)->first();

        if(isset($request->slider_image)){
        $imageName = time().'.'.$request->slider_image->extension();
        $request->slider_image->move(public_path('Assets/Image/slider'), $imageName);
        $slider->slider_image = $imageName;
        }

        $slider->slider_title = $request->slider_title;
        $slider->slider_description = $request->slider_description;

        $slider->save();
        $slider = Slider::get();
        return redirect()->route('addslider')->with('success', "Slider updated successfully.");

    }

    // Delete Slider
    public function destroy($slug){

        $slider = Slider::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/slider/'.$slider->slider_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $slider->delete();
        return redirect()->route('addslider')->with('error', "Slider Deleted successfully.");
    }
}
