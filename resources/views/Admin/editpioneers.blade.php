@extends('Admin.includes.main')
@section('pageTitle', 'Edit Pioneers')
@section('content')
<div class="container col-md-10" style="  margin: auto;
  width: 100%;
  margin-left: 16.5%;
  margin-top: 10px;
  padding: 10px;">
    <form method="POST" action="/admin/pioneers/{{ $pioneers->slug }}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body" style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Name</label>
                <div class="col-8">
                    <input id="text" name="pioneers_name" type="text" class="form-control"
                        value="{{ old('pioneers_name', $pioneers->pioneers_name) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Designation</label>
                <div class="col-8">
                    <input id="text" name="pioneers_designation" type="text" class="form-control"
                        value="{{ old('pioneers_designation', $pioneers->pioneers_designation) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Twitter</label>
                <div class="col-8">
                    <input id="text" name="twitter" type="text" class="form-control"
                        value="{{ old('twitter', $pioneers->twitter) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">LinkedIn</label>
                <div class="col-8">
                    <input id="text" name="linkedin" type="text" class="form-control"
                        value="{{ old('linkedin', $pioneers->linkedin) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Facebook</label>
                <div class="col-8">
                    <input id="text" name="facebook" type="text" class="form-control"
                        value="{{ old('facebook', $pioneers->facebook) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Mail</label>
                <div class="col-8">
                    <input id="text" name="mail" type="text" class="form-control"
                        value="{{ old('mail', $pioneers->mail) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Current Image</label>
                <div class="col-8 text-center">
                    <img src="/Assets/Image/pioneers/{{ $pioneers->pioneers_image }}" class=""
                        Style="margin-top:20px; border-radius:8px;" width="100" height="100">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload Image</label>
                <div class="col-8">
                    <input name="pioneers_image" type="file" class="form-control">
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