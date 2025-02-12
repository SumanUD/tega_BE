@extends('Admin.includes.main')
@section('pageTitle', 'Edit Case Study')
@section('content')
<div class="container col-md-10" style="  margin: auto;
  width: 100%;
  margin-left: 16.5%;
  margin-top: 10px;
  padding: 10px;">
    <form method="POST" action="/admin/casestudy/{{ $casestudy->slug }}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body" style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Title</label>
                <div class="col-8">
                    <input id="text" name="casestudy_title" type="text" class="form-control"
                        value="{{ old('casestudy_title', $casestudy->casestudy_title) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Description</label>
                <div class="col-8">
                    <textarea id="desc" cols="40" rows="5" class="form-control" required="required"
                        name="casestudy_description">{{ old('casestudy_description', $casestudy->casestudy_description) }} </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Current Image</label>
                <div class="col-8 text-center">
                    <img src="/Assets/Image/casestudy/{{ $casestudy->casestudy_image }}" class=""
                        Style="margin-top:20px; border-radius:8px;" width="100" height="100">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload Image</label>
                <div class="col-8">
                    <input name="casestudy_image" type="file" class="form-control">
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