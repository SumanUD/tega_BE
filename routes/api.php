<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevSRK\ProductController;
use App\Http\Controllers\DevSRK\HistoryController;
use App\Http\Controllers\DevSRK\MissionController;
use App\Http\Controllers\DevSRK\VisionController;
use App\Http\Controllers\DevSRK\TestimonialController;
use App\Http\Controllers\DevSRK\IndustryController;
use App\Http\Controllers\DevSRK\PioneersController;
use App\Http\Controllers\DevSRK\BlogController;
use App\Http\Controllers\DevSRK\CasestudyController;
use App\Http\Controllers\DevSRK\FaqController;
use App\Http\Controllers\DevSRK\NewsController;
use App\Http\Controllers\DevSRK\BrochureController;
use App\Http\Controllers\DevSRK\SliderController;
use App\Http\Controllers\DevSRK\JobController;
use App\Http\Controllers\DevSRK\MediaController;
use App\Http\Controllers\DevSRK\EventController;
use App\Http\Controllers\DevSRK\WhitepaperController;
use App\Http\Controllers\DevSRK\Productv2Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admin/addslider',[SliderController::class,'apiindex'])->name('addslider');

Route::get('/admin/addproduct/{product_category}',[ProductController::class,'apiindex'])->name('addproduct');

Route::get('/admin/products/{slug}', [ProductController::class, 'show_products']);

Route::get('/admin/addhistory',[HistoryController::class,'apiindex'])->name('addhistory');

Route::get('/admin/addmission',[MissionController::class,'apiindex'])->name('addmission');

Route::get('/admin/addvision',[VisionController::class,'apiindex'])->name('addvision');

Route::get('/admin/addtestimonial',[TestimonialController::class,'apiindex'])->name('addtestimonial');

Route::get('/admin/addindustry',[IndustryController::class,'apiindex'])->name('addindustry');

Route::get('/admin/addpioneers',[PioneersController::class,'apiindex'])->name('addpioneers');

Route::get('/admin/addblog',[BlogController::class,'apiindex'])->name('addblog');

Route::get('/admin/blog/{slug}', [BlogController::class, 'show_blog']);

Route::get('/admin/addcasestudy',[CasestudyController::class,'apiindex'])->name('addcasestudy');

Route::get('/admin/casestudy/{slug}', [CasestudyController::class, 'show_casestudy']);

Route::get('/admin/addfaq',[FaqController::class,'apiindex'])->name('addfaq');

Route::get('/admin/addnews',[NewsController::class,'apiindex'])->name('addnews');

Route::get('/admin/news/{slug}', [NewsController::class, 'show_news']);

Route::get('/admin/addbrochure',[BrochureController::class,'apiindex'])->name('addbrochure');

Route::get('/admin/addslider',[SliderController::class,'apiindex'])->name('addslider');

Route::get('/admin/addjob',[JobController::class,'apiindex'])->name('addjob');

Route::get('/admin/jobs', [JobController::class, 'show_jobtitle']);

Route::get('/admin/addmedia',[MediaController::class,'apiindex'])->name('addmedia');

Route::get('/admin/addevent',[EventController::class,'apiindex'])->name('addevent');

Route::get('/admin/event/{slug}', [EventController::class, 'show_event']);

Route::get('/admin/addwhitepaper',[WhitepaperController::class,'apiindex'])->name('addwhitepaper');

Route::get('/admin/whitepaper/{slug}', [WhitepaperController::class, 'show_whitepaper']);

// blog CRUD
Route::post('blogcat_create', [BlogController::class, 'create']); 
Route::get('blogcat_getdata', [BlogController::class, 'show']);
Route::get('blogcat_editgetdata/{id}', [BlogController::class, 'show_edit']); 
Route::post('blogcatupdate', [BlogController::class, 'uupdate']);
Route::post('deleteBlogcat', [BlogController::class, 'deleteBlogcat']);
Route::post('/admin/addproductfunction',[Productv2Controller::class,'addproduct_function']);
Route::post('/admin/editproductfunction',[Productv2Controller::class,'editproduct_function']);
Route::get('singleproduct',[Productv2Controller::class,'singleproduct']);
Route::get('/allproduct', [Productv2Controller::class, 'allproduct']);
Route::post('/deleteproduct', [Productv2Controller::class, 'deleteproduct']);