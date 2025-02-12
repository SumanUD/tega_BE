<?php

use App\Http\Controllers\DevSRK\AdminController;
use App\Http\Controllers\DevAJ\HomepageController;
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
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/',[HomepageController::class,'index']);

// Admin Login
Route::get('/',[AuthController::class, 'login'])->name('login');
Route::post('/',[AuthController::class, 'post'])->name('login');

// Admin Logout
Route::get('/admin/logout',[AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/admin/forgot-password', [AuthController::class, 'forgot'])->name('forgot');
Route::post('/admin/forgot-password', [AuthController::class, 'forgot_password']);

// Reset Password
Route::get('/admin/resetpassword/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('/admin/resetpassword/{token}', [AuthController::class, 'post_reset'])->name('reset');

// Middleware - Admin Auth
Route::group(['middleware' => 'auth'], function(){

// Admin Dashboard
Route::get('/admindashboard',[AdminController::class,'index'])->name('admindashboard');

// Admin - Add Product
Route::get('/admin/addproduct',[ProductController::class,'index'])->name('addproduct');

Route::post('/admin/product/store',[ProductController::class, 'store'])->name('product.store');

// Admin - Edit Product
Route::get('/admin/products/{slug}/edit',[ProductController::class,'edit'])->name('product.edit');

Route::put('/admin/product/{slug}/update',[ProductController::class, 'update'])->name('product.update');

// Admin - Delete Product
Route::get('/admin/products/{slug}/delete',[ProductController::class, 'destroy'])->name('product.delete');

// Admin - Add History
Route::get('/admin/addhistory',[HistoryController::class,'index'])->name('addhistory');

Route::post('/admin/history/store',[HistoryController::class, 'store'])->name('history.store');

// Admin - Edit History
Route::get('/admin/history/{slug}/edit',[HistoryController::class,'edit']);

Route::put('/admin/history/{slug}/update',[HistoryController::class, 'update'])->name('history.update');

// Admin - Delete History
Route::get('/admin/history/{slug}/delete',[HistoryController::class, 'destroy'])->name('history.delete');

// Admin - Add Mission
Route::get('/admin/addmission',[MissionController::class,'index'])->name('addmission');

Route::post('/admin/mission/store',[MissionController::class, 'store'])->name('mission.store');

// Admin - Edit Mission
Route::get('/admin/mission/{slug}/edit',[MissionController::class,'edit'])->name('mission.edit');

Route::put('/admin/mission/{slug}/update',[MissionController::class, 'update'])->name('mission.update');

// Admin - Delete Mission
Route::get('/admin/mission/{slug}/delete',[MissionController::class, 'destroy'])->name('mission.delete');

// Admin - Add Vision
Route::get('/admin/addvision',[VisionController::class,'index'])->name('addvision');

Route::post('/admin/vision/store',[VisionController::class, 'store'])->name('vision.store');

// Admin - Edit Vision
Route::get('/admin/vision/{slug}/edit',[VisionController::class,'edit'])->name('vision.edit');

Route::put('/admin/vision/{slug}/update',[VisionController::class, 'update'])->name('vision.update');

// Admin - Delete Vision
Route::get('/admin/vision/{slug}/delete',[VisionController::class, 'destroy'])->name('vision.delete');

// Admin - Add Testimonial
Route::get('/admin/addtestimonial',[TestimonialController::class,'index'])->name('addtestimonial');

Route::post('/admin/testimonial/store',[TestimonialController::class, 'store'])->name('testimonial.store');

// Admin - Edit Testimonial
Route::get('/admin/testimonial/{slug}/edit',[TestimonialController::class,'edit'])->name('testimonial.edit');

Route::put('/admin/testimonial/{slug}/update',[TestimonialController::class, 'update'])->name('testimonial.update');

// Admin - Delete Testimonial
Route::get('/admin/testimonial/{slug}/delete',[TestimonialController::class, 'destroy'])->name('testimonial.delete');

// Admin - Add Industry
Route::get('/admin/addindustry',[IndustryController::class,'index'])->name('addindustry');

Route::post('/admin/industry/store',[IndustryController::class, 'store'])->name('industry.store');

// Admin - Edit Industry
Route::get('/admin/industry/{slug}/edit',[IndustryController::class,'edit'])->name('industry.edit');

Route::put('/admin/industry/{slug}/update',[IndustryController::class, 'update'])->name('industry.update');

// Admin - Delete Industry
Route::get('/admin/industry/{slug}/delete',[IndustryController::class, 'destroy'])->name('industry.delete');

// Admin - Add Pioneers
Route::get('/admin/addpioneers',[PioneersController::class,'index'])->name('addpioneers');

Route::post('/admin/pioneers/store',[PioneersController::class, 'store'])->name('pioneers.store');

// Admin - Edit Pioneers
Route::get('/admin/pioneers/{slug}/edit',[PioneersController::class,'edit'])->name('pioneers.edit');

Route::put('/admin/pioneers/{slug}/update',[PioneersController::class, 'update'])->name('pioneers.update');

// Admin - Delete Pioneers
Route::get('/admin/pioneers/{slug}/delete',[PioneersController::class, 'destroy'])->name('pioneers.delete');

// Admin - Add Blog
Route::get('/admin/addblog',[BlogController::class,'index'])->name('addblog');

Route::post('/admin/blog/store',[BlogController::class, 'store'])->name('blog.store');

// Admin - Edit Blog
Route::get('/admin/blog/{slug}/edit',[BlogController::class,'edit'])->name('blog.edit');

Route::post('/admin/blog/{slug}/update',[BlogController::class, 'update'])->name('blog.update');

// Admin - Delete Blog
Route::get('/admin/blog/{slug}/delete',[BlogController::class, 'destroy'])->name('blog.delete');

Route::get('/admin/addblog/blogsidecat', [BlogController::class, 'sidecatshow']);

Route::get('/admin/editblog/{slug}/blogsidecat', [BlogController::class, 'editsidecatshow']);

// Admin - Add Case Study
Route::get('/admin/addcasestudy',[CasestudyController::class,'index'])->name('addcasestudy');

Route::post('/admin/casestudy/store',[CasestudyController::class, 'store'])->name('casestudy.store');

// Admin - Edit Case Study
Route::get('/admin/casestudy/{slug}/edit',[CasestudyController::class,'edit'])->name('casestudy.edit');

Route::put('/admin/casestudy/{slug}/update',[CasestudyController::class, 'update'])->name('casestudy.update');

// Admin - Delete Case Study
Route::get('/admin/casestudy/{slug}/delete',[CasestudyController::class, 'destroy'])->name('casestudy.delete');

// Admin - Add FAQ
Route::get('/admin/addfaq',[FaqController::class,'index'])->name('addfaq');

Route::post('/admin/faq/store',[FaqController::class, 'store'])->name('faq.store');

// Admin - Edit FAQ
Route::get('/admin/faq/{slug}/edit',[FaqController::class,'edit'])->name('faq.edit');

Route::put('/admin/faq/{slug}/update',[FaqController::class, 'update'])->name('faq.update');

// Admin - Delete FAQ
Route::get('/admin/faq/{slug}/delete',[FaqController::class, 'destroy'])->name('faq.delete');

// Admin - Add News
Route::get('/admin/addnews',[NewsController::class,'index'])->name('addnews');

Route::post('/admin/news/store',[NewsController::class, 'store'])->name('news.store');

// Admin - Edit News
Route::get('/admin/news/{slug}/edit',[NewsController::class,'edit'])->name('news.edit');

Route::put('/admin/news/{slug}/update',[NewsController::class, 'update'])->name('news.update');

// Admin - Delete News
Route::get('/admin/news/{slug}/delete',[NewsController::class, 'destroy'])->name('news.delete');

// Admin - Add Brochure
Route::get('/admin/addbrochure',[BrochureController::class,'index'])->name('addbrochure');

Route::post('/admin/brochure/store',[BrochureController::class, 'store'])->name('brochure.store');

// Admin - Edit Brochure
Route::get('/admin/brochure/{slug}/edit',[BrochureController::class,'edit'])->name('brochure.edit');

Route::put('/admin/brochure/{slug}/update',[BrochureController::class, 'update'])->name('brochure.update');

// Admin - Delete Brochure
Route::get('/admin/brochure/{slug}/delete',[BrochureController::class, 'destroy'])->name('brochure.delete');

// Admin - Add Slider
Route::get('/admin/addslider',[SliderController::class,'index'])->name('addslider');

Route::post('/admin/slider/store',[SliderController::class, 'store'])->name('slider.store');

// Admin - Edit Slider
Route::get('/admin/slider/{slug}/edit',[SliderController::class,'edit'])->name('slider.edit');

Route::put('/admin/slider/{slug}/update',[SliderController::class, 'update'])->name('slider.update');

// Admin - Delete Slider
Route::get('/admin/slider/{slug}/delete',[SliderController::class, 'destroy'])->name('slider.delete');

// Admin - Add Job
Route::get('/admin/addjob',[JobController::class,'index'])->name('addjob');

Route::post('/admin/job/store',[JobController::class, 'store'])->name('job.store');

// Admin - Edit Job
Route::get('/admin/job/{slug}/edit',[JobController::class,'edit'])->name('job.edit');

Route::put('/admin/job/{slug}/update',[JobController::class, 'update'])->name('job.update');

// Admin - Delete Job
Route::get('/admin/job/{slug}/delete',[JobController::class, 'destroy'])->name('job.delete');

// Admin - Add Media
Route::get('/admin/addmedia',[MediaController::class,'index'])->name('addmedia');

Route::post('/admin/media/store',[MediaController::class, 'store'])->name('media.store');

// Admin - Edit Media
Route::get('/admin/media/{slug}/edit',[MediaController::class,'edit'])->name('media.edit');

Route::put('/admin/media/{slug}/update',[MediaController::class, 'update'])->name('media.update');

// Admin - Delete Media
Route::get('/admin/media/{slug}/delete',[MediaController::class, 'destroy'])->name('media.delete');

// Admin - Add Event
Route::get('/admin/addevent',[EventController::class,'index'])->name('addevent');

Route::post('/admin/event/store',[EventController::class, 'store'])->name('event.store');

// Admin - Edit Event
Route::get('/admin/event/{slug}/edit',[EventController::class,'edit'])->name('event.edit');

Route::put('/admin/event/{slug}/update',[EventController::class, 'update'])->name('event.update');

// Admin - Delete Event
Route::get('/admin/event/{slug}/delete',[EventController::class, 'destroy'])->name('event.delete');

// Admin - Add Whitepaper
Route::get('/admin/addwhitepaper',[WhitepaperController::class,'index'])->name('addwhitepaper');

Route::post('/admin/whitepaper/store',[WhitepaperController::class, 'store'])->name('whitepaper.store');

// Admin - Edit Whitepaper
Route::get('/admin/whitepaper/{slug}/edit',[WhitepaperController::class,'edit'])->name('whitepaper.edit');

Route::put('/admin/whitepaper/{slug}/update',[WhitepaperController::class, 'update'])->name('whitepaper.update');

// Admin - Delete Whitepaper
Route::get('/admin/whitepaper/{slug}/delete',[WhitepaperController::class, 'destroy'])->name('whitepaper.delete');

// Product - Version 2
Route::get('/admin/addproductv2',[Productv2Controller::class,'index'])->name('addproduct');
Route::get('/admin/allproducts',[Productv2Controller::class,'productable']);
Route::get('/editproduct/{id}',[Productv2Controller::class,'editproduct']);


});