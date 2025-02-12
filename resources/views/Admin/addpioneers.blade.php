@extends('Admin.includes.main')
@section('pageTitle', 'Add Pioneers')
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
    <form method="POST" action="/admin/pioneers/store" enctype="multipart/form-data"
        style="border: 2px solid #ddd; border-radius: 20px;">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Enter Name</label>
                <div class="col-8">
                    <input id="text" name="pioneers_name" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Enter Designation</label>
                <div class="col-8">
                    <input id="text" name="pioneers_designation" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Twitter</label>
                <div class="col-8">
                    <input id="text" name="twitter" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">LinkedIn</label>
                <div class="col-8">
                    <input id="text" name="linkedin" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Facebook</label>
                <div class="col-8">
                    <input id="text" name="facebook" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Mail</label>
                <div class="col-8">
                    <input id="text" name="mail" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Image</label>
                <div class="col-8">
                    <input name="pioneers_image" type="file" class="form-control">
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
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Social Links</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pioneers as $pioneers)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $pioneers->pioneers_name }}</td>
                    <td>{{ $pioneers->pioneers_designation }}</td>
                    <td>
                        <a target="_blank" href="{{ $pioneers->twitter }}" class="btn btn-primary"><i
                                class="fa-brands fa-twitter"></i></a>
                        <a target="_blank" href="{{ $pioneers->linkedin }}" class="btn btn-primary"><i
                                class="fa-brands fa-linkedin"></i></a>
                        <a target="_blank" href="{{ $pioneers->facebook }}" class="btn btn-primary"><i
                                class="fa-brands fa-facebook"></i></a>
                        <a target="_blank" href="{{ $pioneers->mail }}" class="btn btn-primary"><i
                                class="fa-solid fa-envelope"></i></a>

                    </td>
                    <td>
                        <img src="/Assets/Image/pioneers/{{ $pioneers->pioneers_image }}" class="rounded-circle"
                            width="50" height="50">
                    </td>
                    <td>
                        <a href="/admin/pioneers/{{ $pioneers->slug }}/edit" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="{{ url('/admin/pioneers/' . $pioneers->slug . '/delete') }}" class="btn btn-danger"
                            onClick="confirmation(event)"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection