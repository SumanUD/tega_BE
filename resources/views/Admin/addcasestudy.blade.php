@extends('Admin.includes.main')
@section('pageTitle', 'Add Case Study')
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
    <form method="POST" action="/admin/casestudy/store" enctype="multipart/form-data"
        style="border: 2px solid #ddd; border-radius: 20px;">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Case Study Title</label>
                <div class="col-8">
                    <input id="text" name="casestudy_title" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Case Study Description</label>
                <div class="col-8">
                    <textarea id="desc" name="casestudy_description" cols="40" rows="5" required="required"
                        class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Image</label>
                <div class="col-8">
                    <input name="casestudy_image" type="file" class="form-control">
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
                    <th style="width:50%">Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                div
                @foreach ($casestudy as $casestudy)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $casestudy->casestudy_title }}</td>
                    <td>{!! $casestudy->casestudy_description !!}</td>
                    <td>
                        <img src="/Assets/Image/casestudy/{{ $casestudy->casestudy_image }}" class="rounded-circle"
                            width="50" height="50">
                    </td>
                    <td>
                        <a href="/admin/casestudy/{{ $casestudy->slug }}/edit" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="{{ url('/admin/casestudy/' . $casestudy->slug . '/delete') }}" class="btn btn-danger"
                            onClick="confirmation(event)"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>

</div>
@endsection