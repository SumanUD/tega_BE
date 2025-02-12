<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\addProductModal;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class Productv2Controller extends Controller
{
    public function index(){
        
        return view('Admin.addproductv2');
    }

    public function addproduct_function(Request $request){

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_image' => 'required',
            'product_category' => 'required|string|max:255',
            'product_description' => 'required|string|max:255',
            'variation_offer_gallery' => 'required',
            'variation_offer_description.*' => 'required|string|max:255',
            'variation_key_benefits_question.*' => 'required|string|max:255',
            'variation_key_benefits_answer.*' => 'required|string|max:255',
            'variation_product_feature_title.*' => 'required|string|max:255',
            'variation_product_feature_gallery' => 'required',
            'variation_product_feature_description.*' => 'required|string|max:255',
            'variation_pdf_title.*' => 'required|string|max:255',
            'variation_product_pdf_gallery' => 'required',
            'blog_cat' => 'required',
            'article_cat' => 'required',
            'service_contact' => 'required|digits:10',
            'spares_contact' => 'required|digits:10',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $variation_offer_description =  $request->input('variation_offer_description');
        $variation_product_feature_title =  $request->input('variation_product_feature_title');

        if ($variation_offer_description) {
            $vargalleryPaths = [];
            
            if ($request->hasFile('variation_offer_gallery')) {
                foreach ($request->file('variation_offer_gallery') as $image) {
                    $varoriginalName = Str::random(15) . "." . $image->getClientOriginalExtension();
                    $vargalleryPath = $image->storeAs('product', $varoriginalName, 'public');
                    $vargalleryPaths[] = $varoriginalName;
                }
                $vargalleryPathsString = implode(',', $vargalleryPaths);
            }
        }
        else{
            $vargalleryPathsString = "";
        }
        if ($variation_product_feature_title) {
            $vargalleryProductPaths = [];
            
            if ($request->hasFile('variation_product_feature_gallery')) {
                foreach ($request->file('variation_product_feature_gallery') as $image) {
                    $varoriginalProductName = Str::random(15) . "." . $image->getClientOriginalExtension();
                    $vargalleryProductPath = $image->storeAs('product', $varoriginalProductName, 'public');
                    $vargalleryProductPaths[] = $varoriginalProductName;
                }
                $vargalleryProductPathsString = implode(',', $vargalleryProductPaths);
            }
        }
        else{
            $vargalleryProductPathsString = "";
        }

            $vargalleryProdpdfPaths = [];
            
            if ($request->hasFile('variation_product_pdf_gallery')) {
                foreach ($request->file('variation_product_pdf_gallery') as $image) {
                    $varoriginalProductpdfName = Str::random(15) . "." . $image->getClientOriginalExtension();
                    $vargalleryProductpdfPath = $image->storeAs('product', $varoriginalProductpdfName, 'public');
                    $vargalleryProdpdfPaths[] = $varoriginalProductpdfName;
                }

             $vargalleryProductpdfPathsString = implode(',', $vargalleryProdpdfPaths);

            }
            else{
                $vargalleryProductpdfPathsString = "";
            }

            $what_offer = [];
            foreach ($request->input('variation_offer_description') as $index => $description) { 
                $what_offer[] = [
                    'index' => 'what_offer'.$index,
                    'description' => $description,
                    'gallery_path' => $vargalleryPaths[$index]
                ]; 
            }
            
            $key_benefit = [];
            foreach ($request->input('variation_key_benefits_question') as $index => $question) { 
                $key_benefit[] = [
                    'index' => 'key_benefit'.$index,
                    'question' => $question,
                    'answer' => $request->input('variation_key_benefits_answer')[$index]
                ]; 
            }

            $product_feature = [];
            foreach ($request->input('variation_product_feature_title') as $index => $title) { 
                $product_feature[] = [
                    'index' => 'product_feature'.$index,
                    'title' => $title,
                    'description' => $request->input('variation_product_feature_description')[$index],
                    'gallery_path' => $vargalleryProductPaths[$index],
                ]; 
            }
            
            $product_pdf = [];
            foreach ($request->input('variation_pdf_title') as $index => $pdf_title) { 
                $product_pdf[] = [
                    'index' => 'product_pdf'.$index,
                    'pdf_title' => $pdf_title,
                    'pdf_path' => $vargalleryProdpdfPaths[$index],
                ]; 
            }
            
            // dd($what_offer);
            
            $product_image = $request->file('product_image');
            $product_imageName = time() . '.' . $product_image->extension();
            $product_image->storeAs('public/product', $product_imageName);
            $Product = addProductModal::create([
                'product_name' => $request->input('product_name'),
                'product_image' => $product_imageName,
                'product_category' => $request->input('product_category'),
                'product_description' => $request->input('product_description'),
                'variation_offer_description' => $what_offer,
                'variation_key_benefits_question' => $key_benefit,
                'variation_product_feature_title' => $product_feature,
                'variation_pdf_title' => $product_pdf,
                'spares_contact' => $request->input('spares_contact'),
                'service_contact' => $request->input('service_contact'),
                'blog_cat' => $request->input('blog_cat'),
                'article_cat' => $request->input('article_cat'),
            ]);
            
            
    }

    public function singleproduct(Request $request){
       
        $id = $request->input('id');

        $Product = addProductModal::where('id',$id)->first();
        // dd($Product['variation_pdf_title']);
        
        if ($Product) {
            return response()->json([
                'status' => 200,
                'message' => 'Product Data Fetched Successfully',
                'Product' => $Product,
            ], 200);
        } else {
            return response()->json([
                'status' => 422,
                'error' => 'Something Went Wrong',
                'Product' => $id
            ], 422);
        }
    }

    public function getatval(Request $request){
        $prod_cat = $request->input('prod_cat');
        $prod_cat_parts = explode('-', $prod_cat);
        $prod_cat_joined = implode(' ', $prod_cat_parts);

        $query = Blog::query();
        $blog_array = [];

        // Search by category
        if ($request->has('prod_cat')) {
            $Blog_data = BlogCategory::where('category_name', $prod_cat_joined)->first();
            if ($Blog_data) {
                $query->where('category', 'like', '%' . $Blog_data->id . '%');
                $blog_array[] = $query->get();
            }
        }

        if ($blog_array) {
            $blog_array_val = $blog_array[0];
        }
        else{
            $blog_array_val = [];
        }
      
        $html = '<option value="">Select Blog</option>';
      
        foreach ($blog_array_val as $blog_array_key) {
            $html .= '<option value="'.$blog_array_key->id.'">'.$blog_array_key->blog_title.'</option>';
        }
      
        echo $html;
      }
    public function getatval_article(Request $request){
        $prod_cat = $request->input('prod_cat');
        $prod_cat_parts = explode('-', $prod_cat);
        $prod_cat_joined = implode(' ', $prod_cat_parts);

        $query = Blog::query();
        $blog_array = [];

        // Search by category
        if ($request->has('prod_cat')) {
            $Blog_data = BlogCategory::where('category_name', $prod_cat_joined)->first();
            if ($Blog_data) {
                $query->where('category', 'like', '%' . $Blog_data->id . '%');
                $blog_array[] = $query->get();
            }
        }

        if ($blog_array) {
            $blog_array_val = $blog_array[0];
        }
        else{
            $blog_array_val = [];
        }
      
        $html = '<option value="">Select Article</option>';
      
        foreach ($blog_array_val as $blog_array_key) {
            $html .= '<option value="'.$blog_array_key->id.'">'.$blog_array_key->blog_title.'</option>';
        }
      
        echo $html;
      }

              
    public function allproduct(){

        $allProdcut = addProductModal::orderBy('id','desc')->get();

        if (count($allProdcut) > 0) {
            return response()->json([
                'status' => 200,
                'Products' => $allProdcut
            ],200);
        }

        else {
            return response()->json([
                'status' => 422,
                'message' => 'No Products Found'
            ],422);
        }


    }

      public function productable(){

        $response1 = Http::get('https://tega.codtrees.com/api/allproduct');
        if ($response1->successful()) {
            $data1 = $response1->json();
            $products = $data1["Products"];
        }
       
        return view('Admin.allproducts', [
            'products' => $products,
        ]);

    }

    public function deleteproduct(Request $request){
        $prod_id = $request->input('prod_id');
        $product = addProductModal::find($prod_id);

        if($product){
            $product->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Product Deleted Successfully'
            ],200);
        }
        else{
            return response()->json([
                'status' => 422,
                'error' => "Nothing to Deleted"
            ],422);
        }
    }

    public function editproduct($id){
        $response1 = Http::get('https://tega.codtrees.com/api/updateproddata/' . $id);
        if ($response1->successful()) {
            $data1 = $response1->json();
            $products = $data1["Product"];
        } else {
            print_r("Nothing Found");
        }

        return view('Admin.editproducts', [
            'products' => $products,
        ]);
    }

    public function updateproddata(Request $request,$id){
        $Product = addProductModal::find($id);
        if ($Product) {
            return response()->json([
                'status' => 200,
                'message' => 'Product Data Successfully',
                'Product' => $Product,
            ], 200);
        } else {
            return response()->json([
                'status' => 422,
                'error' => 'Something Went Wrong',
                'Product' => $id
            ], 422);
        }
    }


}
