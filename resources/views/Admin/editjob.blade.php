@extends('Admin.includes.main')
@section('pageTitle', 'Edit Job')
@section('content')
<div class="container col-md-10" style="  margin: auto;
  width: 100%;
  margin-left: 16.5%;
  margin-top: 10px;
  padding: 10px;">
    <form method="POST" action="/admin/job/{{ $job->slug }}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body" style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Job Title</label>
                <div class="col-8">
                    <input id="text" name="job_title" type="text" class="form-control"
                        value="{{ old('job_title', $job->job_title) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Job Location</label>
                <div class="col-8">
                    <input id="text" name="job_location" type="text" class="form-control"
                        value="{{ old('job_location', $job->job_location) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Job Type</label>
                <div class="col-8">
                    <select id="jobtype" style="width:200px; height:25px;" class="text-center" name="job_type">
                        <option value="Select Job Type">Select Job Type</option>
                        <option value="Remote">Remote</option>
                        <option value="In Office">In Office</option>
                      </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Country</label>
                <div class="col-8">
                    <select id="jobcountry" style="width:200px; height:25px;" class="text-center" name="job_country">
                        <option value="Select Country">Select Country</option>
                        <option value="India">India</option>
                        <option value="USA">USA</option>
                        <option value="UK">UK</option>
                        <option value="Australia">Australia</option>
                        <option value="Srilanka">Srilanka</option>
                      </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Job Description</label>
                <div class="col-8">
                    <textarea id="desc" cols="40" rows="5" class="form-control" required="required"
                        name="job_description">{{ old('job_description', $job->job_description) }} </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Job Salary</label>
                <div class="col-8">
                    <input type="number" class="form-control" id="job_salary" name="job_salary" required="required"
                        value="{{ old('job_salary', $job->job_salary) }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8 text-center">
                    <button name="submit" type="submit" class="btn btn-success">UPDATE</button>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>
@endsection