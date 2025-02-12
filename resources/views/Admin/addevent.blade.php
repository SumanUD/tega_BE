@extends('Admin.includes.main')
@section('pageTitle', 'Add Event')
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
    <form method="POST" action="/admin/event/store" style="border: 2px solid #ddd; border-radius: 20px;" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Event Title</label>
                <div class="col-8">
                    <input id="text" name="event_title" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Event Date</label>
                <div class="col-8">
                    <input id="text" name="event_date" type="date" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Event Description</label>
                <div class="col-8">
                    <textarea id="desc" name="event_description" cols="40" rows="5" required="required"
                        class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Image</label>
                <div class="col-8">
                    <input name="event_image" type="file" class="form-control">
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
                    <th>event Title</th>
                    <th>event Date</th>
                    <th style="width:50%">event Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event as $event)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $event->event_title }}</td>
                    <td>{{ $event->event_date }}</td>
                    <td>{!! $event->event_description !!}</td>
                    <td>
                        <img src="/Assets/Image/event/{{ $event->event_image }}" class="rounded-circle" width="50"
                            height="50">
                    </td>
                    <td>
                        <a href="/admin/event/{{ $event->slug }}/edit" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="{{ url('/admin/event/' . $event->slug . '/delete') }}" class="btn btn-danger"
                            onClick="confirmation(event)"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>

</div>
@endsection