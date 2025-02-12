<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function apiindex(){
        $job = Job::get();
        return response()->json($job);
    }

    public function index(){
        $job = Job::get();
        return view('Admin.addjob',['job'=>$job]);
    }

    // Add job
    public function store(Request $request){
        
    $request->validate([
        'job_title' => 'required',
        'job_type' => 'required',
        'job_country' => 'required',
        'job_description' => 'required | max:255',
        'job_location' => 'required',
        'job_salary' => 'required'
    ]);

        $job = new Job;
        $job->job_title = $request->job_title;
        $job->job_type = $request->job_type;
        $job->job_country = $request->job_country;
        $job->job_location = $request->job_location;
        $job->job_description = $request->job_description;
        $job->job_salary = $request->job_salary;

        $job->save();
        return redirect()->back()->with('success', "Job added successfully.");

    }

        // Show Product
        public function show_jobtitle()
        {
            $jobs = Job::select('id', 'job_title')->get();
    
            return response()->json(['jobs' => $jobs], 200);
        }

    // Edit Job
    public function edit($slug){

        $job = Job::where('slug',$slug)->first();

        return view('Admin.editjob',compact('job'));

    }

    // Update Job
    public function update(Request $request, $slug){

        $request->validate([
            'job_title' => 'required',
            'job_type' => 'required',
            'job_country' => 'required',
            'job_description' => 'required | max:255',
            'job_location' => 'required',
            'job_salary' => 'required'
        ]);

        $job = Job::where('slug', $slug)->first();

        $job->job_title = $request->job_title;
        $job->job_type = $request->job_type;
        $job->job_country = $request->job_country;
        $job->job_description = $request->job_description;
        $job->job_location = $request->job_location;
        $job->job_salary = $request->job_salary;

        $job->save();
        $job = Job::get();
        return redirect()->route('addjob')->with('success', "Job updated successfully.");

    }

    // Delete Job
    public function destroy($slug){

        $job = Job::where('slug',$slug)->first();
        $job->delete();
        return redirect()->route('addjob')->with('error', "Job Deleted successfully.");
    }
}
