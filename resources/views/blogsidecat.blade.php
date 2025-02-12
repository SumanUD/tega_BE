<div class="table-responsive">
    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($category as $catdata)
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input blogcatCheckbox" name="category" type="checkbox"
                            value="{{ $catdata['id'] }}" id="blogcatCheckbox{{ $catdata['id'] }}">
                        <label class="form-check-label" for="blogcatCheckbox{{ $catdata['id'] }}"
                            style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">{{
                            $catdata['category_name'] }}</label>
                    </div>
                </td>
                <td>

                    <div class="row" style="display: contents">
                        <a href="#" class="text-success" style="text-decoration: none;" onclick="editBlogcateg({{ $catdata['id'] }})" data-bs-toggle="modal"
                            data-bs-target=".editblogModal_{{ $catdata['id'] }}"><i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" class="text-danger" onclick="deleteBlogCat({{ $catdata['id'] }})"><i class="fa fa-trash"></i>
                        </a>
                    </div>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>


    @foreach ($category as $catdata)
    <!-- Modal -->
    <div class="modal fade  editblogModal_{{ $catdata['id'] }}" id="editBlogModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Blog Category
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form fields to display/edit category details -->
                    <input type="hidden" id="blogcatId_{{ $catdata['id'] }}">
                    <div class="form-group">

                        <label for="category_blog">Update Category</label>
                        <input type="text" class="form-control" id="blogcat_{{ $catdata['id'] }}" required>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        style="background: white;color: green;border: 2px dashed;border-radius: 30px;font-size: 14px;font-weight: bold;"
                        onclick="saveBlogCategory({{ $catdata['id'] }})">Savechanges</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach