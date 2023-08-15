@extends('layouts.app')

@section('title','Create Post')
@section('content')


<form action="{{ route('post.store') }}" method="post"
enctype="multipart/form-data">
    @csrf

<div>
    <p>Category (up to 3)</p>
    @foreach ($all_categories as $category)
       <div class="form-check form-check-inline ">
        <input type="checkbox" name="category[]" id="{{ $category->id }}"
        value="{{ $category->id }}" class="form-check-input">
        <label for="{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
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
    placeholder="What's on your mind" class="form-control"></textarea>
@error('description')
    <div class="text-danger small">{{ $message }}</div>
@enderror

</div>

<div>
    <label for="image">Image</label>
    <input type="file" name="image" id="image" class="form-control">

    <div class="form-text">
        Acceptable formats: jpeg jpg png gif only <br>
        Max file size is 1048kb
    </div>

@error('image')
    <div class="text-danger small">{{ $message }}</div>
@enderror

</div>
<button type="submit" class="btn btn-primary px-5">Post</button>

</form>



@endsection
