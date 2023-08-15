@extends('layouts.app')

@section('title','Admin: Categories')
@section('content')

<div class="container">

  <form action="{{ route('admin.store') }}" method="post">

   @csrf

    <div class="row">
        <div class="col-10">
            <input type="text" name="name"
                placeholder="New Category" class="form-control">
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary form-control">Add</button>
        </div>
    </div>
    @error('name')
      <p class="text-danger small">{{ $message }}</p>
    @enderror

   </form>

<table class="table table-hover align-middle bg-white border text-secondary mt-3">
    <thead class="small table-warning text-secondary">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>COUNT</th>
            <th>LAST UPDATED</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($all_categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->categoryPost->count() }}</td>
            <td>{{ $category->updated_at }}</td>
            <td class="d-flex">
                <button type="button" class="btn btn-warning me-2"
               data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}">Edit
               </button>
               <button type="button" class="btn btn-danger"
               data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}">Delete
               </button>

             @include('admin.categories.modal.delete')
             @include('admin.categories.modal.edit')

            </td>

          </tr>

        @empty

        @endforelse
        <tr>
            <td></td>
            <td class="text-dark">
                Uncategorized
                <p class="xsmall mb-0 text-muted">Hidden posts are not included.</p>
            </td>
            <td>{{ $uncategorized_count }}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
{{-- pagination --}}
<div class="d-flex justify-content-center">
    {{ $all_categories->links() }}
</div>

</div>

@endsection
