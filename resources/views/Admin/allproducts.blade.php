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

    <div class="container col-md-10" style="  margin: auto;width: 100%;margin-left: 16.5%;margin-top: 10px;padding: 10px;">

        <div class="container" style="width: 93%;margin-top:30px;">

            <table id="jaishreeram" class="table table-striped text-center" style="border: 2px solid #ddd !important;">
                <thead>
                    <tr>
                        <th style="width:8%">Sl No.</th>
                        <th style="width:15%">Image</th>
                        <th style="width:15%">Name</th>
                        <th style="width:15%">Category</th>
                        <th style="width:15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach ($products as $productem)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><img src="https://tega.codtrees.com/storage/product/{{ $productem['product_image'] }}"
                                    class="avatar avatar-sm me-3" alt="Tega" style="width: 100px; height:auto"></td>
                            <td>{{ $productem['product_name'] }}</td>
                            <td>{{ $productem['product_category'] }}</td>
                            <td>
                                <div class="row" style="display: contents">
                                    <a href="{{ url('/editproduct', $productem['id']) }}">
                                        <button type="button" class="btn btn-success btn-sm" style="padding: 3px 16px;border-radius: 17px;font-size: 12px;font-weight: 800;letter-spacing: 0.2px;">Edit</button>
                                    </a>
                                    <a href="" onclick="deleteProduct({{ $productem['id'] }})">
                                        <button type="button" class="btn btn-danger btn-sm" style="padding: 3px 16px;border-radius: 17px;font-size: 12px;font-weight: 800;letter-spacing: 0.2px;">Delete</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
                function deleteProduct(productId) {
            if (confirm("Are you sure you want to delete this product?")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'https://tega.codtrees.com/api/deleteproduct',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        prod_id: productId
                    }), // Pass productId in the data object
                    success: function(data) {
                        swal({
                            title: "Product Deleted Successfully",
                            icon: "success",
                            buttons: true,
                        })

                        location.reload();
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
                    }
                });
            }
        }
    </script>


@endsection
