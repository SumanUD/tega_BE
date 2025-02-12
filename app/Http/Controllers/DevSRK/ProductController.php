<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // public function apiindex(){
    //     $products = Product::get();
    //     return response()->json($products);
    // }

    public function apiindex($product_category)
    {
        $product = Product::where('product_category',$product_category)->first();

        if (!$product) {
            return response()->json(['status' => 404, 'error' => 'Product not found'], 404);
        }

        return response()->json(['status' => 200, 'product' => $product], 200);
    }

    public function index(){
        $products = Product::get();
        return view('Admin.addproduct',['products'=>$products]);
    }

    // Add product
    public function store(Request $request){
        
    $request->validate([
        'product_name' => 'required',
        'product_category' => 'required',
        'product_description' => 'required',
        'product_image' => 'required|mimes:jpeg,jpg,png|max:21000',
        'product_file' => 'required|mimes:pdf,doc,docx|max:5000',
        'product_file_name' => 'required'
    ]);

    $product_description = $request->product_description;

    $dom = new \DomDocument();

    $dom->loadHtml($product_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $imageFile = $dom->getElementsByTagName('imageFile');

    foreach($imageFile as $item => $image)
    {

        $data = $img->getAttribute('src');

        list($type, $data) = explode(';', $data);

        list(, $data)      = explode(',', $data);

        $imgeData = base64_decode($data);

        $image_name= "/upload/" . time().$item.'.png';

        $path = public_path('Assets/Image/products') . $image_name;

        file_put_contents($path, $imgeData);
        
        $image->removeAttribute('src');

        $image->setAttribute('src', $image_name);
     }

    $product_description = $dom->saveHTML();


        $imageName = time().'.'.$request->product_image->extension();
        $request->product_image->move(public_path('Assets/Image/products'), $imageName);

        $file = $request->file('product_file');
        $fileName = $file->getClientOriginalName();
        $request->product_file->move(public_path('Assets/File/products'), $fileName);

        
        $product = new Product;
        $product->product_image = $imageName;
        $product->product_name = $request->product_name;
        $product->product_category = $request->product_category;
        $product->product_description = $product_description;
        $product->product_file = $fileName;
        $product->product_file_name = $request->product_file_name;

        $product->save();
        return redirect()->back()->with('success', "Product added successfully.");

    }

    // Show Product
    public function show_products($slug)
    {
        $product = Product::where('slug',$slug)->first();

        if (!$product) {
            return response()->json(['status' => 404, 'error' => 'Product not found'], 404);
        }

        return response()->json(['status' => 200, 'product' => $product], 200);
    }

    // Edit Product
    public function edit($slug){

        $product = Product::where('slug',$slug)->first();

        return view('Admin.editproduct',compact('product'));

    }

    // Update Product
    public function update(Request $request, $slug){

        $request->validate([
            'product_name' => 'required',
            'product_category' => 'required',
            'product_description' => 'required',
            'product_image' => 'nullable|mimes:jpeg,jpg,png|max:21000',
            'product_file' => 'nullable|mimes:pdf,doc,docx|max:5000',
            'product_file_name' => 'required'
        ]);

        $product = Product::where('slug', $slug)->first();

        $product_description = $request->product_description;

        $dom = new \DomDocument();
    
        $dom->loadHtml($product_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
        $imageFile = $dom->getElementsByTagName('imageFile');
    
        foreach($imageFile as $item => $image)
        {
    
            $data = $img->getAttribute('src');
    
            list($type, $data) = explode(';', $data);
    
            list(, $data)      = explode(',', $data);
    
            $imgeData = base64_decode($data);
    
            $image_name= "/upload/" . time().$item.'.png';
    
            $path = public_path('Assets/Image/products') . $image_name;
    
            file_put_contents($path, $imgeData);
            
            $image->removeAttribute('src');
    
            $image->setAttribute('src', $image_name);
         }
    
        $product_description = $dom->saveHTML();

        if(isset($request->product_image)){
        $imageName = time().'.'.$request->product_image->extension();
        $request->product_image->move(public_path('Assets/Image/products'), $imageName);
        $product->product_image = $imageName;
        }

        if(isset($request->product_file)){
            $fileName = $request->product_file_name.'.'.$request->product_file->extension();
            $request->product_file->move(public_path('Assets/File/products'), $fileName);
            $product->product_file = $fileName;
        }
    
        $product->product_file_name = $request->product_file_name;
        $product->product_name = $request->product_name;
        $product->product_category = $request->product_category;
        $product->product_description = $request->product_description;

        $product->save();
        $products = Product::get();
        return redirect()->route('addproduct')->with('success', "Product updated successfully.");

    }

    // Delete Product
    public function destroy($slug){

        $product = Product::where('slug',$slug)->first();
        $image_path = public_path('Assets/Image/products/'.$product->product_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $file_path = public_path('Assets/File/products/'.$product->product_file);
        if(file_exists($file_path)){
            unlink($file_path);
        }
        $product->delete();
        return redirect()->route('addproduct')->with('error', "Product deleted successfully.");
    }
}
