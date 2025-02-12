<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
class MediaController extends Controller
{
    public function apiindex(){
        $media = Media::get();
        return response()->json($media);
    }

    public function index(){
        $media = Media::get();
        return view('Admin.addmedia',['media'=>$media]);
    }

    // Add media
    public function store(Request $request){
        
    $request->validate([
        'media_name' => 'required',
        'media_image' => 'required|mimes:jpeg,jpg,png|max:21000'
    ]);


        $imageName = time().'.'.$request->media_image->extension();
        $request->media_image->move(public_path('Assets/Image/media'), $imageName);

        $media = new Media;
        $media->media_image = $imageName;
        $media->media_name = $request->media_name;

        $media->save();
        return redirect()->back()->with('success', "Media added successfully.");

    }

    // Edit Media
    public function edit($slug){

        $media = Media::where('slug',$slug)->first();

        return view('Admin.editmedia',compact('media'));

    }

    // Update Media
    public function update(Request $request, $slug){

        $request->validate([
            'media_name' => 'required',
            'media_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
        ]);

        $media = Media::where('slug', $slug)->first();

        if(isset($request->media_image)){
        $imageName = time().'.'.$request->media_image->extension();
        $request->media_image->move(public_path('Assets/Image/media'), $imageName);
        $media->media_image = $imageName;
        }

        $media->media_name = $request->media_name;

        $media->save();
        $media = Media::get();
        return redirect()->route('addmedia')->with('success', "Media updated successfully.");

    }

    // Delete Media
    public function destroy($slug){

        $media = Media::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/media/'.$media->media_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $media->delete();
        return redirect()->route('addmedia')->with('Error', "Media Deleted successfully.");
    }
}
