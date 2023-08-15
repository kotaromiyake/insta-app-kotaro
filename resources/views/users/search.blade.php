@extends('layouts.app')

@section('title','Search')
@section('content')

<div class="container w-75">
<p class="text-muted">Search results for "{{ $search }}"</p>

@foreach ($users as $user)
<div class="row align-items-center mb-3">
  <div class="col-auto">
      <a href="{{ route('profile.show',$user->id) }}">
      @if ($user->avatar)
      <img src="{{ $user->avatar }}" alt="{{ $user->avatar }}" class="rounded-circle avatar-md">

      @else
      <i class="fa-solid fa-circle-user text-secondary icon-md"></i>

      @endif</a>
  </div>
  <div class="col ps-0 text-truncate">

      <a href="{{ route('profile.show',$user->id) }}"
          class="fw-bold text-dark text-decoration-none">{{ $user->name }}</a><br>
          <div class="text-muted">{{ $user->email }}</div>
        <div>
            @if ($user->followers->count() == 0)
            <div class="text-muted">No Followers yet</div>
            @else
            <strong class="me-1">{{ $user->followers->count() }}</strong>Follower{{ $user->followers->count()>1 ? 's' : '' }}
            @endif

        </div>
  </div>
  <div class="col-auto">
    @if ($user->id != Auth::user()->id)
                      @if ($user->isFollowed())
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-transparent p-0 text-secondary btn-sm">Following</button>
                    </form>

                      @else
                      <form action="{{ route('follow.store', $user->id) }}" method="post">
                      @csrf
                      <button type="submit"  class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                    </form>

                      @endif

                    @endif
  </div>
</div>

@endforeach
</div>

@endsection
