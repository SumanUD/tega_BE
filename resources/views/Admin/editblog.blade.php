@extends('Admin.includes.main')
@section('pageTitle', 'Edit Blog')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<div class="container col-md-8" style="  margin: auto;
  width: 80%;
  margin-left: 18.5%;
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
    <form method="POST" id="blogupdateform"  enctype="multipart/form-data">
        @csrf
        <div class="card-body" style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Blog Title</label>
                <div class="col-8">
                    <input id="text" name="blog_title" type="text" class="form-control"
                        value="{{ old('blog_title', $blog->blog_title) }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text"></label>
                <div class="col-6">
                    <a href="#" style="text-decoration: none;" class="" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        Click here to select category
                    </a>
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Blog Description</label>
                <div class="col-8">
                    <textarea id="desc" cols="40" rows="5" class="form-control" required="required"
                        name="blog_description">{{ old('blog_description', $blog->blog_description) }} </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Current Image</label>
                <div class="col-8 text-center">
                    <img src="/Assets/Image/blog/{{ $blog->blog_image }}" class=""
                        Style="margin-top:20px; border-radius:8px;" width="100" height="100">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label" for="text">Upload Image</label>
                <div class="col-8">
                    <input name="blog_image" type="file" class="form-control" id="selectImage">
                    <img id="preview" src="#" alt="your image" class="text-center" width="300px" style="display:none;"/>
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

        {{-- OFF Canvas start --}}

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form id="blog_category">
                    <div class="text-center">
                        <label class="col-form-label" for="text">Enter Category</label>
                        <input id="text" name="category_name" type="text" class="form-control catsto" required="required">
                        <span class="catval" style="color: red;"></span>
                        <button name="submit" type="submit" class="btn btn-primary mt-3 mb-3">SUBMIT</button>
                    </div>
                </form>
                <div class="catigo">
                </div>
            </div>
        </div>
    
        {{-- OFF Canvas End --}}

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

function blogcat(){
        $('.catigo').load("/admin/editblog/<?php echo $blog->slug; ?>/blogsidecat").fadeIn("slow");
    }
    $(document).ready(function() {
        blogcat();
    });

    $('#blogupdateform').on('submit', function(e) {
            e.preventDefault();

            selectedItems = [];

            $('.blogcateditCheckbox:checked').each(function() {
                var blogcatName = $(this).val();
                selectedItems.push(blogcatName);
            });

            var selectedItemsString = selectedItems.join(', ');

            var formData = new FormData(this);

            formData.append('category', selectedItemsString);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('blog.update', ['slug' => $blog->slug]) }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    swal({
                        title: 'Successfully',
                        type: 'success',
                        showCloseButton: true
                    });

                    location.reload();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    swal({
                        title: 'Please Check Some Error Occured',
                        type: 'error',
                        showCloseButton: true
                    });

                    var proderror = JSON.parse(jqXHR.responseText).errors;
                    if (proderror.blog_image) {
                        $('.blog_image').html(proderror.blog_image[0]);
                    } else {
                        $('.blog_image').html('');
                    }
                    if (proderror.blog_title) {
                        $('.blog_title').html(proderror.blog_title[0]);
                    } else {
                        $('.blog_title').html('');
                    }

                    if (proderror.blog_description) {
                        $('.blog_description').html(proderror.blog_description[0]);
                    } else {
                        $('.blog_description').html('');
                    }
                }
            });
        });

    $('#blog_category').on('submit', function(e) {
            e.preventDefault();


            var formData = new FormData(this);



            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'https://tega.codtrees.com/api/blogcat_create',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    swal({
                        title: 'Successfully',
                        type: 'success',
                        showCloseButton: true
                    });
                    blogcat();
                    $('.catsto').val('');

                    // window.location.href = "{{ url('/allblogs') }}";

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    swal({
                        title: 'Please Check Some Error Occured',
                        type: 'error',
                        showCloseButton: true
                    });

                    var proderror = JSON.parse(jqXHR.responseText).errors;
                    if (proderror.category_name) {
                        $('.catval').html(proderror.category_name[0]);
                    } else {
                        $('.catval').html('');
                    }

                }
            });
        });
    


    function editBlogcateg(blogId) {
            $.get('https://tega.codtrees.com/api/blogcat_editgetdata/' + blogId, function(response) {
                console.log(response);
                $('#blogcatId_' + blogId).val(response.content.id);
                $('#blogcat_' + blogId).val(response.content.category_name);
            });
        }

        
        function saveBlogCategory(blogId) {
            var blogId = $('#blogcatId_' + blogId).val();
            var blogCateg = $('#blogcat_' + blogId).val();

            var data = {
                id: blogId,
                category_name: blogCateg,
                // Add other fields if needed
            };

            // Send data to the server through a POST API call
            if (confirm("Are you sure you want to change the Category?")) {
                $.ajax({
                    url: 'https://tega.codtrees.com/api/blogcatupdate',
                    type: 'POST', // Assuming you're using PUT method for updating category
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {

                        swal({
                            title: 'updated successfully!',
                            type: 'success',
                            showCloseButton: true
                        });

                        blogcat();

                        $('#editBlogModal').modal('hide');
                        // You can reload the page or update the UI as needed
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        swal({
                            title: 'Some Error Happens Here!',
                            type: 'error',
                            showCloseButton: true
                        });

                    }
                });
            }
        }

        function deleteBlogCat(blogId) {
    if (confirm("Are you sure you want to delete this blog category?")) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'https://tega.codtrees.com/api/deleteBlogcat',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                blogcat_id: blogId
            }), // Pass productId in the data object
            success: function(data) {
                swal({
                    title: 'Deleted Successfully',
                    type: 'success',
                    showCloseButton: true
                });

                blogcat();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error response
                swal({
                    title: 'Some Error Happens Here!',
                    type: 'error',
                    showCloseButton: true
                });

                var proderror = JSON.parse(jqXHR.responseText).errors;
                console.log(proderror);
            }
        });
    }
}

</script>
@endsection