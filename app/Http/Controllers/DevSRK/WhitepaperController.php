<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Whitepaper;

class WhitepaperController extends Controller
{
    public function apiindex(){
        $whitepaper = Whitepaper::get();
        return response()->json($whitepaper);
    }
    
    public function index(){
        $whitepaper = Whitepaper::get();
        return view('Admin.addwhitepaper',['whitepaper'=>$whitepaper]);
    }

    // Add whitepaper
    public function store(Request $request){
        
    $request->validate([
        'whitepaper_title' => 'required',
        'whitepaper_image' => 'required|mimes:jpeg,jpg,png|max:21000'
    ]);


        $imageName = time().'.'.$request->whitepaper_image->extension();
        $request->whitepaper_image->move(public_path('Assets/Image/whitepaper'), $imageName);

        $whitepaper = new Whitepaper;
        $whitepaper->whitepaper_image = $imageName;
        $whitepaper->whitepaper_title = $request->whitepaper_title;

        $whitepaper->save();
        return redirect()->back()->with('success', "Whitepaper added successfully.");

    }

        // Show Whitepaper
        public function show_whitepaper($slug)
        {
            $whitepaper = Whitepaper::where('slug',$slug)->first();
    
            if (!$whitepaper) {
                return response()->json(['status' => 404, 'error' => 'Whitepaper not found'], 404);
            }
    
            return response()->json(['status' => 200, 'whitepaper' => $whitepaper], 200);
        }

    // Edit Whitepaper
    public function edit($slug){

        $whitepaper = Whitepaper::where('slug',$slug)->first();

        return view('Admin.editwhitepaper',compact('whitepaper'));

    }

    // Update Whitepaper
    public function update(Request $request, $slug){

        $request->validate([
            'whitepaper_title' => 'required',
            'whitepaper_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
        ]);

        $whitepaper = Whitepaper::where('slug', $slug)->first();

        if(isset($request->whitepaper_image)){
        $imageName = time().'.'.$request->whitepaper_image->extension();
        $request->whitepaper_image->move(public_path('Assets/Image/whitepaper'), $imageName);
        $whitepaper->whitepaper_image = $imageName;
        }

        $whitepaper->whitepaper_title = $request->whitepaper_title;

        $whitepaper->save();
        $whitepaper = Whitepaper::get();
        return redirect()->route('addwhitepaper')->with('success', "Whitepaper updated successfully.");

    }

    // Delete Whitepaper
    public function destroy($slug){

        $whitepaper = Whitepaper::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/whitepaper/'.$whitepaper->whitepaper_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $whitepaper->delete();
        return redirect()->route('addwhitepaper')->with('Error', "Whitepaper Deleted successfully.");
    }
}
