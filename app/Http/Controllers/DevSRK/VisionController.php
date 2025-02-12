<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vision;

class VisionController extends Controller
{
    public function apiindex(){
        $vision = Vision::get();
        return response()->json($vision);
    }

    public function index(){
        $vision = Vision::get();
        return view('Admin.addvision',['vision'=>$vision]);
    }

        // Add Vision
        public function store(Request $request){
        
            $request->validate([
                'vision_title' => 'required',
                'vision_description' => 'required | max:255',
            ]);
    
            $vision = new Vision;
            $vision->vision_title = $request->vision_title;
            $vision->vision_description = $request->vision_description;
    
            $vision->save();
            return redirect()->back()->with('success', "Vision added successfully.");
    
        }

        // Edit Vision
        public function edit($slug){

        $vision = Vision::where('slug',$slug)->first();

        return view('Admin.editvision',['vision' => $vision]);

    }

        // Update Vision
        public function update(Request $request, $slug){

            $request->validate([
                'vision_title' => 'required',
                'vision_description' => 'required | max:255',
            ]);
    
            $vision = Vision::where('slug', $slug)->first();
    
            $vision->vision_title = $request->vision_title;
            $vision->vision_description = $request->vision_description;
    
            $vision->save();
            $vision = Vision::get();
            return redirect()->route('addvision')->with('success', "Vision updated successfully.");
    
        }

        // Delete Vision
        public function destroy($slug){
        $vision = Vision::where('slug',$slug)->first();
        $vision->delete();
        return redirect()->route('addvision')->with('Error', "Vision Deleted successfully.");
    }
}
