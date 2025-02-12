<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function apiindex(){
        $news = News::get();
        return response()->json($news);
    }

    public function index(){
        $news = News::get();
        return view('Admin.addnews',['news'=>$news]);
    }


    // Add news
    public function store(Request $request){
        
    $request->validate([
        'news_title' => 'required',
        'news_description' => 'required | max:255',
        'news_image' => 'required|mimes:jpeg,jpg,png|max:21000'
    ]);


        $imageName = time().'.'.$request->news_image->extension();
        $request->news_image->move(public_path('Assets/Image/news'), $imageName);

        $news = new News;
        $news->news_image = $imageName;
        $news->news_title = $request->news_title;
        $news->news_description = $request->news_description;

        $news->save();
        return redirect()->back()->with('success', "News added successfully.");

    }

        // Show News
        public function show_news($slug)
        {
            $news = News::where('slug',$slug)->first();
    
            if (!$news) {
                return response()->json(['status' => 404, 'error' => 'News not found'], 404);
            }
    
            return response()->json(['status' => 200, 'news' => $news], 200);
        }

    // Edit News
    public function edit($slug){

        $news = News::where('slug',$slug)->first();

        return view('Admin.editnews',compact('news'));

    }

    // Update News
    public function update(Request $request, $slug){

        $request->validate([
            'news_title' => 'required',
            'news_description' => 'required | max:255',
            'news_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
        ]);

        $news = News::where('slug', $slug)->first();

        if(isset($request->news_image)){
        $imageName = time().'.'.$request->news_image->extension();
        $request->news_image->move(public_path('Assets/Image/news'), $imageName);
        $news->news_image = $imageName;
        }

        $news->news_title = $request->news_title;
        $news->news_description = $request->news_description;

        $news->save();
        $news = News::get();
        return redirect()->route('addnews')->with('success', "Mission updated successfully.");

    }

    // Delete News
    public function destroy($slug){

        $news = News::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/news/'.$news->news_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $news->delete();
        return redirect()->route('addnews')->with('Error', "Mission Deleted successfully.");
    }
}
