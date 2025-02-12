@extends('Admin.includes.main')
@section('pageTitle', 'Add Product')
@section('content')
<div class="container col-md-8" style="  margin: auto;
  width: 100%;
  margin-left: 25%;
  margin-top: 30px;
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
    <form method="POST" action="/admin/product/store" enctype="multipart/form-data"
        style="border: 2px solid #ddd; border-radius: 20px;">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Product Name</label>
                <div class="col-8">
                    <input id="text" name="product_name" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Product Category</label>
                <div class="col-8">
                    <select id="productcategory" style="width:200px; height:25px;" class="text-center" name="product_category">
                        <option value="null" disabled selected hidden>Select Product Category</option>
                        <option value="grinding_equipments">Grinding Equipments</option>
                        <option value="screening_equipments">Screening Equipments</option>
                        <option value="feeding_equipments">Feeding Equipments</option>
                        <option value="crushing">Crushing</option>
                        <option value="job_shop">Job Shop</option>
                        <option value="construction_equipments">Construction Equipments</option>
                        <option value="equpment_for_steel_plants">Equipment for Steel Plants</option>
                        <option value="process_plant_equipments">Process Plant Equipments</option>
                        <option value="ash_handling_equipment">Ash Handling Equipment</option>
                        <option value="material_handling_equipment">Material Handling Equipment</option>
                      </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Short Description</label>
                <div class="col-8">
                    <textarea name="short_description" cols="40" rows="5" required="required"
                        class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Long Description</label>
                <div class="col-8">
                    <textarea id="desc" name="product_description" cols="40" rows="5" required="required"
                        class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Product Image</label>
                <div class="col-8">
                    <input name="product_image" type="file" class="form-control" accept="image/*" id="selectImage">
                    <img src="#" id="imagePreview" width="300px" style="display:none; margin-top: 5vh; margin-left:22vh; border-radius:5px;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload File</label>
                <div class="col-8">
                    <input name="product_file" type="file" accept="application/pdf" class="form-control">
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
        <table id="tablelisting" class="table table-striped text-center" style="border: 2px solid #ddd !important;">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <img src="/public/Assets/Image/products/{{ $product->product_image }}" width="75">
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_category }}</td>
                    <td>
                        <a target="_blank" href="/public/Assets/File/products/{{ $product->product_file }}"
                            class="text-success"><i class="fa-solid fa-file-pdf"></i></a>
                    </td>
                    <td>
                        <a href="/admin/products/{{ $product->slug }}/edit" class="text-warning mr-2"><i
                                class="fa-solid fa-pen"></i></a>
                        <a href="{{ url('/admin/products/' . $product->slug . '/delete') }}" class="text-danger"
                            onClick="confirmation(event)"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection