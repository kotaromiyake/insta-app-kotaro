@extends('layouts.app')

@section('title','Home')
@section('content')
   <div class="row gx-5">
    <div class="col-8">
        @forelse ($all_posts as $post)
            @include('users.posts.contents.title')
            @include('users.posts.contents.body')

        @empty
        <div class="text-center">
            <h2>Share Photo</h2>
            <p class="text-muted">
                When you share photos, they'll appear on your profile.
            </p>
            <a href="{{ route('post.create') }}" class="text-decoration-none">share your first photo.</a>
        </div>
        @endforelse
    </div>
    <div class="col-4">
        {{-- profile overview --}}
        <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
            <div class="col-auto">
                <a href="{{ route('profile.show',Auth::user()->id) }}">
                @if ( Auth::user()->avatar )
                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->avatar }}"
                class="rounded-circle avatar-md">
                @else
                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>

                @endif
            </a>
            </div>
            <div class="col ps-0">
                <a href="{{ route('profile.show',Auth::user()->id) }}">
                <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
            </a>
            </div>
        </div>
        {{-- suggestions --}}
        @if ($suggested_users)
          <div class="row mb-3">
            <div class="col-auto">
                Suggestion For You
            </div>
            <div class="col text-end">
                <a href="#" class="fw-bold text-dark text-decoration-none">See All</a>
            </div>
          </div>

          {{-- display suggestions users --}}
          @foreach ($suggested_users as $user)
          <div class="row align-items-center mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show',$user->id) }}">
                @if ($user->avatar)
                <img src="{{ $user->avatar }}" alt="{{ $user->avatar }}" class="rounded-circle avatar-sm">

                @else
                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>

                @endif</a>
            </div>
            <div class="col ps-0 text-truncate">
                <a href="{{ route('profile.show',$user->id) }}"
                    class="fw-bold text-dark text-decoration-none">{{ $user->name }}</a>
            </div>
            <div class="col-auto">
                <form action="{{ route('follow.store',$user->id) }}" method="POST">
                @csrf
                <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
            </form>
            </div>
          </div>

          @endforeach

        @endif
    </div>
   </div>

@endsection
