@extends('Admin.includes.main')
@section('pageTitle', 'Add Job')
@section('content')
<div class="container col-md-10" style="  margin: auto;
  width: 100%;
  margin-left: 16.5%;
  margin-top: 10px;
  padding: 10px;">
    <div class="alertmessage">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <form method="POST" action="/admin/job/store" enctype="multipart/form-data"
        style="border: 2px solid #ddd; border-radius: 20px;">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Job Title</label>
                <div class="col-8">
                    <input id="text" name="job_title" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Job Location</label>
                <div class="col-8">
                    <input id="text" name="job_location" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Job Type</label>
                <div class="col-8">
                    <select id="jobtype" style="width:200px; height:25px;" class="text-center" name="job_type">
                        <option value="null">Select Job Type</option>
                        <option value="Remote">Remote</option>
                        <option value="In Office">In Office</option>
                      </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Country</label>
                <div class="col-8">
                    <select id="jobcountry" style="width:200px; height:25px;" class="text-center" name="job_country">
                        <option value="null">Select Country</option>
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
                    <textarea id="desc" name="job_description" cols="40" rows="5" required="required"
                        class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Job Salary</label>
                <div class="col-8">
                    <input type="number" class="form-control" id="job_salary" name="job_salary" required="required">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8 text-center">
                    <button name="submit" type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </form>

    <div class="container" style="  margin: auto;
    width: 100%;
    margin-top:30px;
    padding: 10px;">
        <table class="table table-striped text-center" style="border: 2px solid #ddd !important;">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th style="width:40%">Description</th>
                    <th>Salary (₹)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($job as $job)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $job->job_title }}</td>
                    <td>{{ $job->job_location }}</td>
                    <td>{!! $job->job_description !!}</td>
                    <td>₹ {{ $job->job_salary }}</td>
                    <td>
                        <a href="/admin/job/{{ $job->slug }}/edit" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="{{ url('/admin/job/' . $job->slug . '/delete') }}" class="btn btn-danger"
                            onClick="confirmation(event)"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection