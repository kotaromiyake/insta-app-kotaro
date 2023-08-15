@extends('layouts.app')

@section('title','Edit Post')
@section('content')

<form action="{{ route('post.update',$post->id) }}" method="post"
enctype="multipart/form-data">
    @csrf
    @method('PATCH')

<div>
    <p>Category (up to 3)</p>
    @foreach ($all_categories as $category)
       <div class="form-check form-check-inline ">
        @if (in_array($category->id, $selected_categories))
        <input type="checkbox" name="category[]" id="{{ $category->id }}"
        value="{{ $category->id }}" class="form-check-input" checked>
        @else
        <input type="checkbox" name="category[]" id="{{ $category->name }}"
        value="{{ $category->id }}" class="form-check-input">
        @endif
        <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
        </div>
    @endforeach
@error('category')
<div class="text-danger small">{{ $message }}</div>
@enderror


</div>
<div>
    <label for="description">Description</label>
    <br>
    <textarea name="description" id="description" rows="3"
     class="form-control">{{ old('description', $post->description) }}</textarea>
@error('description')
    <div class="text-danger small">{{ $message }}</div>
@enderror

</div>


<div class="row mb-4">
    <div class="col-6">
    <label for="image">Image</label>
    <img src="{{ $post->image }}" alt="{{ $post->image }}" class="img-thumbnail w-100">
    <input type="file" name="image" id="image" class="form-control mt-1">

    <div class="form-text">
        Acceptable formats: jpeg jpg png gif only <br>
        Max file size is 1048kb
    </div>

@error('image')
    <div class="text-danger small">{{ $message }}</div>
@enderror
</div>

</div>
<button type="submit" class="btn btn-warning px-5">Save</button>

</form>

@endsection
