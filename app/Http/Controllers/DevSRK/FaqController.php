<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function apiindex(){
        $faq = Faq::get();
        return response()->json($faq);
    }

    public function index(){
        $faq = Faq::get();
        return view('Admin.addfaq',['faq'=>$faq]);
    }

    // Add faq
    public function store(Request $request){
        
    $request->validate([
        'faq_question' => 'required',
        'faq_answer' => 'required | max:255',
    ]);

        $faq = new Faq;
        $faq->faq_question = $request->faq_question;
        $faq->faq_answer = $request->faq_answer;

        $faq->save();
        return redirect()->back()->with('success', "FAQ added successfully.");

    }

    // Edit Faq
    public function edit($slug){

        $faq = Faq::where('slug',$slug)->first();

        return view('Admin.editfaq',compact('faq'));

    }

    // Update Faq
    public function update(Request $request, $slug){

        $request->validate([
            'faq_question' => 'required',
            'faq_answer' => 'required  | max:255',
        ]);

        $faq = Faq::where('slug', $slug)->first();

        $faq->faq_question = $request->faq_question;
        $faq->faq_answer = $request->faq_answer;

        $faq->save();
        $faq = Faq::get();
        return redirect()->route('addfaq'->with('success', "FAQ updated successfully."));

    }

    // Delete Faq
    public function destroy($slug){

        $faq = Faq::where('slug',$slug)->first();
        $faq->delete();
        return redirect()->route('addfaq')->with('error', "FAQ Deleted successfully.");
    }
}
