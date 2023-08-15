@extends('layouts.app')

@section('title','User Profile')
@section('content')

{{-- profile header --}}
@include('users.profile.header')

{{-- users posts --}}
<div style="margin-top: 100px">

<div class="row">
@forelse ($user->posts as $post)

    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('post.show',$post->id) }}">
        <img src="{{ $post->image }}" alt="{{ $post->image }}" class="grid-img"></a>
    </div>

@empty
<h3 class="text-muted text-center">No Posts Yet.</h3>

@endforelse
</div>
</div>

@endsection

