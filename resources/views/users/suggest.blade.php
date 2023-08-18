@extends('layouts.app')

@section('title','Suggested Users')
@section('content')

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

@endsection
