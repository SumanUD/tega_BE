@extends('Admin.includes.main')
@section('pageTitle', 'Edit Event')
@section('content')
<div class="container col-md-10" style="  margin: auto;
  width: 100%;
  margin-left: 16.5%;
  margin-top: 10px;
  padding: 10px;">
    <form method="POST" action="/admin/event/{{ $event->slug }}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body" style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Event Title</label>
                <div class="col-8">
                    <input id="text" name="event_title" type="text" class="form-control"
                        value="{{ old('event_title', $event->event_title) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Event Date</label>
                <div class="col-8">
                    <input id="text" name="event_date" type="date" class="form-control"
                        value="{{ old('event_date', $event->event_date) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Event Description</label>
                <div class="col-8">
                    <textarea id="desc" cols="40" rows="5" class="form-control" required="required"
                        name="event_description">{{ old('event_description', $event->event_description) }} </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Current Image</label>
                <div class="col-8 text-center">
                    <img src="/Assets/Image/event/{{ $event->event_image }}" class=""
                        Style="margin-top:20px; border-radius:8px;" width="100" height="100">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload Image</label>
                <div class="col-8">
                    <input name="event_image" type="file" class="form-control">
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