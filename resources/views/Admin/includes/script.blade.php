<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to Delete this post?",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {
                window.location.href = urlToRedirect;
            }  
        });
    }
    $(document).ready(function() {
        $('#desc').summernote({
            height:250
        });
    });

    $('#selectImage').change(function() {
        readURL(this);
    });

    // Function to read the image URL
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).show();
                
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready( function () {
    $('#jaishreeram').DataTable();
} );
    
</script>