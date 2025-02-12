<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function apiindex(){
        $history = History::get();
        return response()->json($history);
    }

    public function index(){
        $history = History::get();
        return view('Admin.addhistory',['history'=>$history]);
    }

        // Add History
        public function store(Request $request){
        
            $request->validate([
                'history_title' => 'required',
                'history_description' => 'required | max:255',
            ]);
    
            $history = new History;
            $history->history_title = $request->history_title;
            $history->history_description = $request->history_description;
    
            $history->save();
            return redirect()->back()->with('success', "History added successfully.");
    
        }

        // Edit History
        public function edit($slug){

        $history = History::where('slug',$slug)->first();

        return view('Admin.edithistory',['history' => $history]);

    }

        // Update History
        public function update(Request $request, $slug){

            $request->validate([
                'history_title' => 'required',
                'history_description' => 'required | max:255',
            ]);
    
            $history = History::where('slug', $slug)->first();
    
            $history->history_title = $request->history_title;
            $history->history_description = $request->history_description;
    
            $history->save();
            $history = History::get();
            return redirect()->route('addhistory')->with('success', "History updated successfully.");
    
        }

            // Delete History
    public function destroy($slug){
        $history = History::where('slug',$slug)->first();
        $history->delete();
        return redirect()->route('addhistory')->with('error', "History deleted successfully.");
    }
}
