<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 modal-title text-warning">
                    Edit Category
                </h3>
            </div>
            <form action="{{ route('admin.update',$category->id) }}" method="post">
                @csrf
                @method('PATCH')
            <div class="modal-body">
                <input type="text" name="name" placeholder="Edit a Category" class="form-control"
                value="{{ old('name', $category->name) }}" autofocus>
            </div>
            <div class="modal-footer border-0">

                    <button type="button" class="btn btn-outline-warning btn-sm"
                    data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>






