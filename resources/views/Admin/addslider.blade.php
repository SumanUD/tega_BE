@extends('Admin.includes.main')
@section('pageTitle', 'Add Slider')
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
    <form method="POST" action="/admin/slider/store" enctype="multipart/form-data"
        style="border: 2px solid #ddd; border-radius: 20px;">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Slider Title</label>
                <div class="col-8">
                    <input id="text" name="slider_title" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Slider Description</label>
                <div class="col-8">
                    <textarea maxlength="250" id="desc" name="slider_description" cols="40" rows="5" required="required"
                        class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload Image</label>
                <div class="col-8">
                    <input name="slider_image" type="file" class="form-control">
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
                    <th style="width:40%">Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slider as $slider)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $slider->slider_title }}</td>
                    <td>{!! $slider->slider_description !!}</td>
                    <td>
                        <img src="/Assets/Image/slider/{{ $slider->slider_image }}" class="rounded-circle" width="50"
                            height="50">
                    </td>
                    <td>
                        <a href="/admin/slider/{{ $slider->slug }}/edit" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="{{ url('/admin/slider/' . $slider->slug . '/delete') }}" class="btn btn-danger"
                            onClick="confirmation(event)"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection