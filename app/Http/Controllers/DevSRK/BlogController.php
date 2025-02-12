<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    public function sidecatshow(){
        $response1 = Http::get('https://tega.codtrees.com/api/blogcat_getdata');
        if ($response1->successful()) {
            $data1 = $response1->json();
        } else {
            print_r("Nothing Found");
        }
        
        
        return view('blogsidecat', [
            'category' => $data1["content"]
        ]);
    }

    public function editsidecatshow($slug){
        
        $blog = Blog::where('slug',$slug)->first();
        if ($blog) {
            $data1 = $blog;
        } else {
            print_r("Nothing Found");
        }

        $response2 = Http::get('https://tega.codtrees.com/api/blogcat_getdata');
        if ($response2->successful()) {
            $data2 = $response2->json();
        } else {
            print_r("Nothing Found");
        }

        return view('editblogsidecat', [
            'blog' => $data1,
            'allcategory' => $data2["content"],
        ]);
    }

    // BLOG CRUD - START
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|unique:blogcategory|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' =>$validator->messages()
            ],422);
        }
        else {
            $blog_cat =   BlogCategory::create([
                'category_name' => $request->category_name,
            ]);

            if ($blog_cat) {
                return response()->json([
                    'status' => 200,
                    'message' =>"Created Successfully"
                ],200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' =>"Error Happend"
                ],500);
            }
        }

    }

    public function show(){
        // Find the blog
        $blog_cat = BlogCategory::orderBy('id','desc')->get();
        if ($blog_cat) {
            // Return view for 404 error
            return response()->json([
                'status' => 200,
                'content' => $blog_cat
            ],200);
        }
        else{
            return response()->json([
                'status' => 422,
                'errors' => "Nothing Found"
            ],422);
        }
    }

    public function show_edit($id){
        // Find the blog
        $blog_cat = BlogCategory::find($id);
        if ($blog_cat) {
            // Return view for 404 error
            return response()->json([
                'status' => 200,
                'content' => $blog_cat
            ],200);
        }
        else{
            return response()->json([
                'status' => 422,
                'errors' => "Nothing Found"
            ],422);
        }
    }

    public function uupdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' =>$validator->messages()
            ],422);
        }
        else {
            $id = $request->input('id');
            $blog_cat = BlogCategory::find($id);
            if ($blog_cat) {

                $blog_cat->update([
                    'category_name' => $request->category_name
                ]);

                return response()->json([
                    'status' => 200,
                    'content' => $blog_cat
                ],200);
            }
            else{
                return response()->json([
                    'status' => 422,
                    'errors' => "Nothing Found"
                ],422);
            }
          }

    }

    public function deleteBlogcat(Request $request){
        $blogcat_id = $request->input('blogcat_id');
        $blog_cat = BlogCategory::find($blogcat_id);

        if($blog_cat){
            $blog_cat->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Deleted Successfully'
            ],200);
        }
        else{
            return response()->json([
                'status' => 422,
                'error' => "Nothing to Deleted"
            ],422);
        }
    }

    // BLOG CRUD - END

    public function apiindex(){
        $blog = Blog::get();
        return response()->json($blog);
    }

    public function index(){
        $blog = Blog::get();
        return view('Admin.addblog',['blog'=>$blog]);
    }

    // Add blog
    public function store(Request $request){
        
    $request->validate([
        'blog_title' => 'required',
        'blog_description' => 'required | max:255',
        'category' => 'required | max:255',
        'blog_image' => 'required|mimes:jpeg,jpg,png|max:21000'
    ]);


    $file = $request->file('blog_image');
    $imageName = $file->getClientOriginalName();
        $request->blog_image->move(public_path('Assets/Image/blog'), $imageName);

        $blog = new Blog;
        $blog->blog_image = $imageName;
        $blog->blog_title = $request->blog_title;
        $blog->category = $request->input('category');
        $blog->blog_description = $request->blog_description;

        $blog->save();
        return redirect()->back()->with('success', "Blog added successfully.");

    }

        // Show Blog
        public function show_blog($slug)
        {
            $blog = Blog::where('slug',$slug)->first();
    
            if (!$blog) {
                return response()->json(['status' => 404, 'error' => 'Blog not found'], 404);
            }
    
            return response()->json(['status' => 200, 'blog' => $blog], 200);
        }

    // Edit Blog
    public function edit($slug){

        $blog = Blog::where('slug',$slug)->first();

        return view('Admin.editblog',compact('blog'));

    }

    // Update Blog
    public function update(Request $request, $slug){

        $request->validate([
            'blog_title' => 'required',
            'category' => 'required | max:255',
            'blog_description' => 'required | max:255',
            'blog_image' => 'nullable|mimes:jpeg,jpg,png|max:21000'
        ]);

        $blog = Blog::where('slug', $slug)->first();
        

        if(isset($request->blog_image)){
            $file = $request->file('blog_image');
            $imageName = $file->getClientOriginalName();
            $image_path = public_path('Assets/Image/blog/'.$blog->blog_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $request->blog_image->move(public_path('Assets/Image/blog'), $imageName);
        $blog->blog_image = $imageName;
        }

        $blog->blog_title = $request->blog_title;
        $blog->category = $request->input('category');
        $blog->blog_description = $request->blog_description;

        $blog->save();
        $blog = Blog::get();
        return redirect()->back()->with('success', "Blog updated successfully.");

    }

    // Delete Blog
    public function destroy($slug){

        $blog = Blog::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/blog/'.$blog->blog_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $blog->delete();
        return redirect()->route('addblog')->with('error', "Blog deleted successfully.");
    }
}
