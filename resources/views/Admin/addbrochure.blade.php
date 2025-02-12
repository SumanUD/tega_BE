@extends('Admin.includes.main')
@section('pageTitle', 'Add Brochure')
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
    <form method="POST" action="/admin/brochure/store" enctype="multipart/form-data"
        style="border: 2px solid #ddd; border-radius: 20px;">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Brochure Title</label>
                <div class="col-8">
                    <input id="text" name="brochure_title" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload File</label>
                <div class="col-8">
                    <input name="brochure_file" type="file" class="form-control">
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
                    <th>File Name</th>
                    <th>File Preview</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brochure as $brochure)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $brochure->brochure_file }}</td>
                    <td>
                        <a target="_blank" href="/Assets/file/brochure/{{ $brochure->brochure_file }}"
                            class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i></a>
                    </td>
                    <td>
                        <a href="/admin/brochure/{{ $brochure->slug }}/edit" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="{{ url('/admin/brochure/' . $brochure->slug . '/delete') }}" class="btn btn-danger"
                            onClick="confirmation(event)"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection