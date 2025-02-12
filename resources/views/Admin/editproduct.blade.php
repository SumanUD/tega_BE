@extends('Admin.includes.main')
@section('pageTitle', 'Edit Product')
@section('content')
<div class="container col-md-10" style="  margin: auto;
  width: 100%;
  margin-left: 16.5%;
  margin-top: 10px;
  padding: 10px;">
    <form method="POST" action="/admin/product/{{ $product->slug }}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body" style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Product Name</label>
                <div class="col-8">
                    <input id="text" name="product_name" type="text" class="form-control"
                        value="{{ old('product_name', $product->product_name) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Product Category</label>
                <div class="col-8">
                    <select id="jobtype" style="width:200px; height:25px;" class="text-center" name="product_category">
                        <option value="null" {{ $product['product_category'] == 'null' ? 'selected' : '' }}>Select Product Category</option>
                        <option value="grinding_equipments" {{ $product['product_category'] == 'grinding_equipments' ? 'selected' : '' }}>Grinding Equipments</option>
                        <option value="screening_equipments" {{ $product['product_category'] == 'screening_equipments' ? 'selected' : '' }}>Screening Equipments</option>
                        <option value="feeding_equipments" {{ $product['product_category'] == 'feeding_equipments' ? 'selected' : '' }}>Feeding Equipments</option>
                        <option value="crushing" {{ $product['product_category'] == 'crushing' ? 'selected' : '' }}>Crushing</option>
                        <option value="job_shop" {{ $product['product_category'] == 'job_shop' ? 'selected' : '' }}>Job Shop</option>
                        <option value="construction_equipments" {{ $product['product_category'] == 'construction_equipments' ? 'selected' : '' }}>Construction Equipments</option>
                        <option value="equpment_for_steel_plants" {{ $product['product_category'] == 'equpment_for_steel_plants' ? 'selected' : '' }}>Equipment for Steel Plants</option>
                        <option value="process_plant_equipments" {{ $product['product_category'] == 'process_plant_equipments' ? 'selected' : '' }}>Process Plant Equipments</option>
                        <option value="ash_handling_equipment" {{ $product['product_category'] == 'ash_handling_equipment' ? 'selected' : '' }}>Ash Handling Equipment</option>
                        <option value="material_handling_equipment" {{ $product['product_category'] == 'material_handling_equipment' ? 'selected' : '' }}>Material Handling Equipment</option>
                      </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Product Description</label>
                <div class="col-8">
                    <textarea id="desc" cols="40" rows="5" class="form-control" required="required"
                        name="product_description">{{ old('product_description', $product->product_description) }} </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Current Image</label>
                <div class="col-8 text-center">
                    <img src="/Assets/Image/products/{{ $product->product_image }}" class=""
                        Style="margin-top:20px; border-radius:8px;" width="100" height="100">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload Image</label>
                <div class="col-8">
                    <input name="product_image" type="file" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload File</label>
                <div class="col-8">
                    <input name="product_file" type="file" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">File Name</label>
                <div class="col-8">
                    <input id="text" name="product_file_name" type="text" class="form-control"
                        value="{{ old('product_file_name', $product->product_file_name) }}" required="required">
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