@extends('Admin.includes.main')
@section('pageTitle', 'Edit FAQ')
@section('content')
<div class="container col-md-10" style="  margin: auto;
  width: 100%;
  margin-left: 16.5%;
  margin-top: 10px;
  padding: 10px;">
    <form method="POST" action="/admin/faq/{{ $faq->slug }}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body" style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Question</label>
                <div class="col-8">
                    <input id="text" name="faq_question" type="text" class="form-control"
                        value="{{ old('faq_question', $faq->faq_question) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Answer</label>
                <div class="col-8">
                    <input id="text" name="faq_answer" type="text" class="form-control"
                        value="{{ old('faq_answer', $faq->faq_answer) }}" required="required">
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