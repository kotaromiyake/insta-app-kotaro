@extends('layouts.app')

@section('title','Edit Profile')
@section('content')


<div class="row justify-content-center">
    <div class="col-8">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
        class="bg-white shadow rounded-3">

            @csrf
            @method('PATCH')


            <div class="card border border-0">
                <div class="card-body">
                    <h1>Update profile</h1>
                    <div class="row">
                        <div class="col-4">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->avatar }}" class="img-thumbnail d-block rounded-circle mx-auto avatar-lg">
                  @else
                  <i class="fa-solid fa-circle-user fa-10x d-block text-secondary"></i>
                  @endif
                        </div>
                        <div class="col-8">
                            <input type="file" name="avatar" id="avatar" class="form-control mt-3">
                    <div class="form-text" id="avatar-info">
                        Acceptable formats: jpeg, jpg, png, gif, only <br>
                        Max file size is 1048kb
                    </div>

                     {{-- ERROR --}}
                     @error('avatar')
                     <p class="text-danger small">{{ $message }}</p>
                    @enderror
                        </div>
                    </div>

                    <label for="name" class="form-label mt-3 fw-bold">Name</label>
                    <input type="text" name="name" id="name" class="form-control"  value="{{ $user->name }}" required>
                     {{-- ERROR --}}
                     @error('name')
                     <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="email" class="form-label mt-3">E-Mail address</label>
                    <input type="email" name="email" id="email" class="form-control"  value="{{ $user->email }}" required>
                     {{-- ERROR --}}
                     @error('email')
                     <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="password" class="form-label mt-3">Password</label>
                    <input type="password" name="password" id="password" class="form-control"  required>
                     {{-- ERROR --}}
                     @error('password')
                     <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="introduction" class="mt-3 form-label">Introduction</label>
                    <textarea name="introduction" id="introduction"
                    cols="30" rows="5" class="form-control" placeholder="Describe yourself">{{ $user->introduction }}</textarea>

                     {{-- ERROR --}}
                     @error('introduction')
                     <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-warning mt-3">Save</button>
                </div>

            </div>

        </form>
    </div>
</div>



@endsection
