<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;

class MissionController extends Controller
{
    public function apiindex(){
        $mission = Mission::get();
        return response()->json($mission);
    }

    public function index(){
        $mission = Mission::get();
        return view('Admin.addmission',['mission'=>$mission]);
    }

        // Add Mission
        public function store(Request $request){
        
            $request->validate([
                'mission_title' => 'required',
                'mission_description' => 'required | max:255',
            ]);
    
            $mission = new Mission;
            $mission->mission_title = $request->mission_title;
            $mission->mission_description = $request->mission_description;
    
            $mission->save();
            return redirect()->back()->with('success', "Mission added successfully.");
    
        }

        // Edit Mission
        public function edit($slug){

        $mission = Mission::where('slug',$slug)->first();

        return view('Admin.editmission',['mission' => $mission]);

    }

        // Update Mission
        public function update(Request $request, $slug){

            $request->validate([
                'mission_title' => 'required',
                'mission_description' => 'required | max:255',
            ]);
    
            $mission = Mission::where('slug', $slug)->first();
    
            $mission->mission_title = $request->mission_title;
            $mission->mission_description = $request->mission_description;
    
            $mission->save();
            $mission = Mission::get();
            return redirect()->route('addmission')->with('success', "Mission updated successfully.");
    
        }

        // Delete Mission
        public function destroy($slug){
        $mission = Mission::where('slug',$slug)->first();
        $mission->delete();
        return redirect()->route('addmission')->with('Error', "Mission Deleted successfully.");
    }
}
