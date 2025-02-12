@extends('Admin.includes.main')
@section('pageTitle', 'Add Product')
@section('content')

    <style>
        .var_relative {
            border-radius: 50px;
            position: relative;
        }

        .prod_offer_button_remove {
            top: -12rem;
            left: 24rem;
        }

        .prod_key_button_remove {
            top: -6rem;
            right: -52rem;

        }

        .prod_prodfeature_button_remove {
            top: -18rem;
            right: -52rem;

        }

        .prod_prodpdf_button_remove {
            left: 50rem;
            top: -10rem;
        }
    </style>

    <div class="container col-md-10"
        style="  margin: auto;
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
        <form id="addproductupload" enctype="multipart/form-data"
            style="border: 2px solid #ddd; border-radius: 20px;  width: 95%; margin-left: 46px;">
            @csrf
            <div class="card-body" style="padding: 36px 52px;">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="col-form-label" for="text">Product Name</label>
                        <input id="text" name="product_name" type="text" class="form-control" required="required" placeholder="Please enter product name">
                        <span class="product_name" style="color: red"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label" for="text">Product Image</label>
                        <input name="product_image" type="file" accept="image/*" class="form-control">
                        <span class="product_image" style="color: red"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="col-form-label" for="text">Select Blog</label>
                        <br>
                        <select id="jobtype_2"
                                style="width: 100%; height: 37px; border: 2px solid #ced4da; border-radius: 5px; cursor: pointer;"
                                class="text-center blog_category" name="blog_cat">
                            <option value="">Select Blog</option>
                            @foreach ($blogs as $blog)
                                <option value="{{ $blog->id }}">{{ $blog->blog_title }}</option>
                            @endforeach
                        </select>
                
                        <span class="blog_cat" style="color: red"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label" for="text">Select Article</label>
                        <br>
                        <select id="jobtype_3"
                            style="width: 100%; height: 37px;border: 2px solid #ced4da;border-radius: 5px;cursor: pointer;"
                            class="text-center article_category" name="article_cat">
                            <option value="">Select Article</option>
                            @foreach ($blogs as $blog)
                                <option value="{{ $blog->id }}">{{ $blog->blog_title }}</option>
                            @endforeach
                        </select>
                        <span class="article_cat" style="color: red"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label" for="text">Product Category</label>
                        <br>
                        <select id="jobtype"
                            style="width: 100%; height: 37px;border: 2px solid #ced4da;border-radius: 5px;cursor: pointer;"
                            class="text-center" name="product_category">
                            <option value="">Select Product Category</option>
                            <option value="grinding-equipments">Grinding Equipments</option>
                            <option value="screening-equipments">Screening Equipments</option>
                            <option value="feeding-equipments">Feeding Equipments</option>
                            <option value="crushing">Crushing</option>
                            <option value="job-shop">Job Shop</option>
                            <option value="construction-equipments">Construction Equipments</option>
                            <option value="equpment-for-steel-plants">Equipment for Steel Plants</option>
                            <option value="process-plant-equipments">Process Plant Equipments</option>
                            <option value="ash-handling-equipment">Ash Handling Equipment</option>
                            <option value="material-handling-equipment">Material Handling Equipment</option>
                        </select>
                        <span class="product_category" style="color: red"></span>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" for="text">Service Contact</label>
                        <input id="text" name="service_contact" type="number" class="form-control"
                            required="required" placeholder="Please enter service contact">
                        <span class="service_contact" style="color: red"></span>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" for="text">Spare Contact</label>
                        <input id="text" name="spares_contact" type="number" class="form-control" required="required" placeholder="Please enter spare contact">
                        <span class="spares_contact" style="color: red"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="textarea" class="col-4 col-form-label">Product Description</label>
                        <textarea id="desc" name="product_description" cols="40" rows="5" class="form-control"></textarea>

                        <span class="product_description" style="color: red"></span>
                    </div>
                </div>

                <!-- /.card-body -->

                {{-- ============================ Dyanmic Data Offer ==================== --}}
                <div class="col-lg-12 var_prod" id="product_offer_box">
                    <div class="error_offer_box">
                        <span class="variation_gallery" style="color: red"></span>
                        <br>
                        <span class="variation_description" style="color: red"></span>
                    </div>
                    <button type="button" class="btn btn-success product_offer_button" onclick="add_more()"
                        style="margin-bottom: 18px;">
                        <i class="fa fa-plus"></i>&nbsp; Add Offer</button>
                </div>
                {{-- ============================ Dyanmic Data Offer ==================== --}}

                {{-- ============================ Dyanmic Data Key Benefits ==================== --}}
                <div class="col-lg-12 var_prod" id="product_key_box">
                    <div class="error_offer_box">
                        <span class="variation_question" style="color: red"></span>
                        <br>
                        <span class="variation_answer" style="color: red"></span>
                    </div>
                    <button type="button" class="btn btn-success product_key_button" onclick="add_keynefits()"
                        style="margin-bottom: 18px;">
                        <i class="fa fa-plus"></i>&nbsp; Add Key Benefits</button>
                </div>
                {{-- ============================ Dyanmic Data Key Benefits ==================== --}}

                {{-- ============================ Dyanmic Data Product Feature ==================== --}}
                <div class="col-lg-12 var_prod" id="product_feature_box">
                    <div class="error_offer_box">
                        <span class="variation_prodtitle" style="color: red"></span>
                        <br>
                        <span class="variation_prodgallery" style="color: red"></span>
                        <br>
                        <span class="variation_proddesc" style="color: red"></span>
                    </div>
                    <button type="button" class="btn btn-success product_feature_button" onclick="add_product_feature()"
                        style="margin-bottom: 18px;">
                        <i class="fa fa-plus"></i>&nbsp; Add Product Feature</button>
                </div>
                {{-- ============================ Dyanmic Data Product Feature ==================== --}}

                {{-- ============================ Dyanmic Data Product PDF ==================== --}}
                <div class="col-lg-12 var_prod" id="product_pdf_box">
                    <div class="error_offer_box">
                        <span class="variation_prodpdftitle" style="color: red"></span>
                        <br>
                        <span class="variation_prodpdf" style="color: red"></span>
                    </div>
                    <button type="button" class="btn btn-success product_pdf_button" onclick="add_product_pdf()"
                        style="margin-bottom: 18px;">
                        <i class="fa fa-plus"></i>&nbsp; Add Product PDF</button>
                </div>
                {{-- ============================ Dyanmic Data Product PDF ==================== --}}

                <button type="submit" class="btn btn-primary">SUBMIT</button>

            </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>

        $('#addproductupload').submit(function(e) {
            e.preventDefault();

            //alert("click");
            //var data = $('#addproductform').serialize();
            var frmData = new FormData(this);

            //console.log(data);
            //alert(data);
            $.ajax({
                type: 'POST',
                data: frmData,
                url: 'http://127.0.0.1:8000/api/admin/addproductfunction',
                processData: false,
                contentType: false,
                success: function(data) {
                    swal({
                        title: "Success",
                        icon: "success",
                        buttons: true,
                    })
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    swal({
                        title: "Something error happend",
                        icon: "error",
                        buttons: true,
                    })
                    var proderror = JSON.parse(jqXHR.responseText).errors;
                    console.log(proderror);

                    if (proderror.product_name) {
                        $('.product_name').html(proderror.product_name[0]);
                    } else {
                        $('.product_name').html('');
                    }
                    if (proderror.product_image) {
                        $('.product_image').html(proderror.product_image[0]);
                    } else {
                        $('.product_image').html('');
                    }
                    if (proderror.product_category) {
                        $('.product_category').html(proderror.product_category[0]);
                    } else {
                        $('.product_category').html('');
                    }
                    if (proderror.spares_contact) {
                        $('.spares_contact').html(proderror.spares_contact[0]);
                    } else {
                        $('.spares_contact').html('');
                    }
                    if (proderror.service_contact) {
                        $('.service_contact').html(proderror.service_contact[0]);
                    } else {
                        $('.service_contact').html('');
                    }
                    if (proderror.product_description) {
                        $('.product_description').html(proderror.product_description[0]);
                    } else {
                        $('.product_description').html('');
                    }
                    if (proderror.variation_offer_gallery) {
                        $('.variation_offer_gallery').html("Offer Gallery cannot be null");
                    } else {
                        $('.variation_offer_gallery').html('');
                    }
                    if (proderror.blog_cat) {
                        $('.blog_cat').html("Blog Category Cannot be null");
                    } else {
                        $('.blog_cat').html('');
                    }
                    if (proderror.article_cat) {
                        $('.article_cat').html("Article Category Cannot be null");
                    } else {
                        $('.article_cat').html('');
                    }
                    if (proderror.variation_product_feature_gallery) {
                        $('.variation_prodgallery').html("Product Feature Gallery cannot be null");
                    } else {
                        $('.variation_prodgallery').html('');
                    }
                    if (proderror.variation_product_pdf_gallery) {
                        $('.variation_prodpdf').html("Product PDF cannot be null");
                    } else {
                        $('.variation_prodpdf').html('');
                    }

                    const pattern1 = /^variation_offer_description\.\d+$/;
                    const pattern2 = /^variation_key_benefits_question\.\d+$/;
                    const pattern3 = /^variation_key_benefits_answer\.\d+$/;
                    const pattern4 = /^variation_product_feature_title\.\d+$/;
                    const pattern5 = /^variation_product_feature_description\.\d+$/;
                    const pattern6 = /^variation_pdf_title\.\d+$/;
                    let hasVariationOfferError = false;
                    let hasVQuestionerror = false;
                    let hasVAnswererror = false;
                    let hasVprodtitleerror = false;
                    let hasVproddescriptionerror = false;
                    let hasVprodpdferror = false;
                    for (const key in proderror) {

                        if (pattern1.test(key)) {
                            hasVariationOfferError = true;
                            continue; // Exit the loop if a price error is found
                        }
                        if (pattern2.test(key)) {
                            hasVQuestionerror = true;
                            continue; // Exit the loop if a price error is found
                        }
                        if (pattern3.test(key)) {
                            hasVAnswererror = true;
                            continue; // Exit the loop if a price error is found
                        }
                        if (pattern4.test(key)) {
                            hasVprodtitleerror = true;
                            continue; // Exit the loop if a price error is found
                        }
                        if (pattern5.test(key)) {
                            hasVproddescriptionerror = true;
                            continue; // Exit the loop if a price error is found
                        }
                        if (pattern6.test(key)) {
                            hasVprodpdferror = true;
                            continue; // Exit the loop if a price error is found
                        }
                    }

                    if (hasVariationOfferError) {
                        $('.variation_description').html("Description cannot be null or more than 255");
                        $('.box_error').show();
                    } else {
                        $('.variation_description').html('');
                        $('.box_error').hide();
                    }
                    if (hasVQuestionerror) {
                        $('.variation_question').html("Question cannot be null or more than 255");
                        $('.box_error').show();
                    } else {
                        $('.variation_question').html('');
                        $('.box_error').hide();
                    }
                    if (hasVAnswererror) {
                        $('.variation_answer').html("Answer cannot be null or more than 255");
                        $('.box_error').show();
                    } else {
                        $('.variation_answer').html('');
                        $('.box_error').hide();
                    }
                    if (hasVprodtitleerror) {
                        $('.variation_prodtitle').html(
                            "Product Feature Title cannot be null or more than 255");
                        $('.box_error').show();
                    } else {
                        $('.variation_prodtitle').html('');
                        $('.box_error').hide();
                    }
                    if (hasVproddescriptionerror) {
                        $('.variation_proddesc').html(
                            "Product Feature Description cannot be null or more than 255");
                        $('.box_error').show();
                    } else {
                        $('.variation_proddesc').html('');
                        $('.box_error').hide();
                    }
                    if (hasVprodpdferror) {
                        $('.variation_prodpdftitle').html(
                            "Product Pdf Title cannot be null or more than 255");
                        $('.box_error').show();
                    } else {
                        $('.variation_prodpdftitle').html('');
                        $('.box_error').hide();
                    }
                }
            });

        });
    </script>
    {{-- dynamic offer script --}}
    <script>
        var loop_count = 1;

        function add_more() {
            loop_count++;
            var html = '<input id="offer" type="hidden"><div class="card" id="product_offer_' + loop_count +
                '"><div class="card-body"><div class="form-group"><div class="row" style="margin-top: 21px;">';


            html +=
                '<div class="col-md-12 mb-5"><h4 style="text-align:center"> Offer Section </h4></div>';

            html +=
                '<div class="col-md-6"> <span class="badge rounded-pill text-bg-warning"><span style="color: white;font-size: 11px;text-decoration: underline;">Image Size Should be less than 2mb</span></span><label for="variation_gallery' +
                loop_count + '" class="control-label mb-1"> Image</label><input id="variation_gallery' + loop_count +
                '" name="variation_offer_gallery[]" type="file" class="form-control" accept="image/*" aria-required="true" aria-invalid="false" onchange="previewmultipleImage(this, \'previewmultiple_image_' +
                loop_count + '\')"></div>';


            html +=
                '<div class="col-md-6"><label for="offer_description" class="control-label mb-1">Offer Description</label><textarea id="offer_desc" name="variation_offer_description[]" cols="40" rows="5" required="required"class="form-control" placeholder="Please enter description"></textarea><span class="variation_offer_description' +
                loop_count + '" style="color: red"></span></div>';

            html +=
                '<div class="col-md-6"><label for="variation_gallery' + loop_count +
                '" class="control-label mb-1"> Image Preview</label><div id="previewmultiple_image_' + loop_count +
                '"></div></div>';



            html +=
                '<div class="col-md-6 remo_button"><label for="varattr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-lg var_relative prod_offer_button_remove" style="border: 2px dotted red;" onclick=remove_more("' +
                loop_count + '")><i class="fa fa-times" aria-hidden="true"></i></button></div>';

            html += '</div></div></div></div>';

            $('#product_offer_box').append(html);
        }

        function remove_more(loop_count) {
            $('#product_offer_' + loop_count).remove();
        }


        function previewmultipleImage(input, previewId) {
            if (input.files && input.files[0]) {
                var filesAmount = input.files.length;
                var preview = document.getElementById(previewId);

                preview.innerHTML = ''; // Clear previous previews

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        var img = document.createElement('img');
                        img.src = event.target.result;
                        img.style.maxWidth = '50%'; // Adjust image style as needed
                        preview.appendChild(img);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
    {{-- dynamic offer script --}}


    {{-- dynamic keybenefits script --}}
    <script>
        var key_loop_count = 1;

        function add_keynefits() {
            key_loop_count++;

            var key_html = '<input id="key_benefit" type="hidden"><div class="card" id="product_key_' +
                key_loop_count +
                '"><div class="card-body"><div class="form-group"><div class="row" style="margin-top: 21px;">';


            key_html +=
                '<div class="col-md-12 mb-5"><h4 style="text-align:center"> Key Benefits Section </h4></div>';

            key_html +=
                '<div class="col-md-6"><label for="varques" class="control-label mb-1"> Question</label><input id="varques" name="variation_key_benefits_question[]" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Please enter question"></div>';

            key_html +=
                '<div class="col-md-6"><label for="varans" class="control-label mb-1"> Answer</label><input id="varans" name="variation_key_benefits_answer[]" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Please enter answer"></div>';

            key_html +=
                '<div class="col-md-6 remo_button"><label for="varattr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-lg var_relative prod_key_button_remove" style="border: 2px dotted red;" onclick=key_remove_more("' +
                key_loop_count + '")><i class="fa fa-times" aria-hidden="true"></i></button></div>';

            key_html += '</div></div></div></div>';

            $('#product_key_box').append(key_html);
        }

        function key_remove_more(key_loop_count) {
            $('#product_key_' + key_loop_count).remove();
        }
    </script>
    {{-- dynamic keybenefits script --}}

    {{-- dynamic Productfeature script --}}
    <script>
        var prodfea_loop_count = 1;

        function add_product_feature() {
            prodfea_loop_count++;

            var prodfea_html =
                '<input id="product_feature" type="hidden"><div class="card" id="product_feature_' +
                prodfea_loop_count +
                '"><div class="card-body"><div class="form-group"><div class="row" style="margin-top: 21px;">';


            prodfea_html +=
                '<div class="col-md-12 mb-5"><h4 style="text-align:center"> Product Feature Section </h4></div>';

            prodfea_html +=
                '<div class="col-md-6"><label for="var_prodfea_title" class="control-label mb-1"> Title</label><input id="var_prodfea_title" name="variation_product_feature_title[]" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Please enter title"></div>';

            prodfea_html +=
                '<div class="col-md-6"> <span class="badge rounded-pill text-bg-warning"><span style="color: white;font-size: 11px;text-decoration: underline;">Image Size Should be less than 2mb</span></span><label for="variation_product_feature_gallery' +
                prodfea_loop_count + '" class="control-label mb-1"> Image</label><input id="variation_gallery' +
                prodfea_loop_count +
                '" name="variation_product_feature_gallery[]" type="file" class="form-control" accept="image/*" aria-required="true" aria-invalid="false" onchange="previewmultipleImage_productfeature(this, \'previewmultiple_product_variation_image_' +
                prodfea_loop_count + '\')"></div>';


            prodfea_html +=
                '<div class="col-md-6 mt-2"><label for="variation_product_feature_description" class="control-label mb-1">Product Feature Description</label><textarea id="oofer_desc" name="variation_product_feature_description[]" cols="40" rows="5" required="required"class="form-control" placeholder="Please enter description"></textarea></div>';

            prodfea_html +=
                '<div class="col-md-6"><label for="variation_product_feature_gallery' + prodfea_loop_count +
                '" class="control-label mb-1"> Image Preview</label><div id="previewmultiple_product_variation_image_' +
                prodfea_loop_count +
                '"></div></div>';

            prodfea_html +=
                '<div class="col-md-6 remo_button"><label for="varattr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-lg var_relative prod_prodfeature_button_remove" style="border: 2px dotted red;" onclick=prodfea_remove_more("' +
                prodfea_loop_count + '")><i class="fa fa-times" aria-hidden="true"></i></button></div>';

            prodfea_html += '</div></div></div></div>';

            $('#product_feature_box').append(prodfea_html);
        }

        function prodfea_remove_more(prodfea_loop_count) {
            $('#product_feature_' + prodfea_loop_count).remove();
        }

        function previewmultipleImage_productfeature(input, previewId) {
            if (input.files && input.files[0]) {
                var filesAmount = input.files.length;
                var preview = document.getElementById(previewId);

                preview.innerHTML = ''; // Clear previous previews

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        var img = document.createElement('img');
                        img.src = event.target.result;
                        img.style.maxWidth = '50%'; // Adjust image style as needed
                        preview.appendChild(img);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
    {{-- dynamic Product feature script --}}

    {{-- dynamic Product PDF script --}}
    <script>
        var prodpdf_loop_count = 1;

        function add_product_pdf() {
            prodpdf_loop_count++;

            var prodpdf_html =
                '<input id="prod_pdf" type="hidden"><div class="card" id="product_pdf_' +
                prodpdf_loop_count +
                '"><div class="card-body"><div class="form-group"><div class="row" style="margin-top: 21px;">';


            prodpdf_html +=
                '<div class="col-md-12 mb-5"><h4 style="text-align:center"> Product PDF Upload Section </h4></div>';

            prodpdf_html +=
                '<div class="col-md-6"><label for="varpdftitle" class="control-label mb-1"> Pdf Title</label><input id="varpdftitle" name="variation_pdf_title[]" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Please enter title"></div>';

            prodpdf_html +=
                '<div class="col-md-6"> <span class="badge rounded-pill text-bg-warning"><span style="color: white;font-size: 11px;text-decoration: underline;">Image Size Should be less than 2mb</span></span><label for="variation_product_pdf_gallery' +
                prodpdf_loop_count + '" class="control-label mb-1">Upload Pdf</label><input id="variation_gallery' +
                prodpdf_loop_count +
                '" name="variation_product_pdf_gallery[]" type="file" class="form-control" accept=".pdf" aria-required="true" aria-invalid="false"></div>';


            prodpdf_html +=
                '<div class="col-md-6 remo_button"><label for="varattr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-lg var_relative prod_prodpdf_button_remove" style="border: 2px dotted red;" onclick=prodpdf_remove_more("' +
                prodpdf_loop_count + '")><i class="fa fa-times" aria-hidden="true"></i></button></div>';

            prodpdf_html += '</div></div></div></div>';

            $('#product_pdf_box').append(prodpdf_html);
        }

        function prodpdf_remove_more(prodpdf_loop_count) {
            $('#product_pdf_' + prodpdf_loop_count).remove();
        }
    </script>
    {{-- dynamic Product PDF script --}}


@endsection
