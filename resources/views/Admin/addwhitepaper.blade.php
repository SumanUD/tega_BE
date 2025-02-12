@extends('Admin.includes.main')
@section('pageTitle', 'Add Whitepaper')
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
    <form method="POST" action="/admin/whitepaper/store" enctype="multipart/form-data"
        style="border: 2px solid #ddd; border-radius: 20px;">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Whitepaper Title</label>
                <div class="col-8">
                    <input id="text" name="whitepaper_title" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload Image</label>
                <div class="col-8">
                    <input name="whitepaper_image" type="file" class="form-control" required="required">
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
                    <th>Whitepaper Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($whitepaper as $whitepaper)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $whitepaper->whitepaper_title }}</td>
                    <td>
                        <img src="/Assets/Image/whitepaper/{{ $whitepaper->whitepaper_image }}" class="rounded-circle"
                            width="50" height="50">
                    </td>
                    <td>
                        <a href="/admin/whitepaper/{{ $whitepaper->slug }}/edit" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="{{ url('/admin/whitepaper/' . $whitepaper->slug . '/delete') }}" class="btn btn-danger"
                            onClick="confirmation(event)"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection