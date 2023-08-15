@extends('layouts.app')

@section('title','Following')
@section('content')

{{-- profile header --}}
@include('users.profile.header')

<div style="margin-top:100px">

    @if ($user->following->isNotEmpty())
    <div class="row justify-content-center">

    <div class="col-4">
        <h3 class="text-center text-muted">Followings</h3>

            @foreach ($user->following as $following)
            <div class="row align-items-center mt-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show',$following->following->id) }}">
                        @if($following->following->avatar)
                        <img src="{{ $following->following->avatar }}" alt="{{ $following->following->avatar }}"
                        class="rounded-circle avatar-sm"></a>

                        @else
                        <i class="fa-solid fa-circle-user text-secondary text-center icon-sm"></i>
                      @endif
                    </a>
                </div>

                <div class="col ps-0 text-truncate">
                    <a href="{{ route('profile.show',$following->following->id) }}"
                        class="text-decoration-none text-dark fw-bold">{{ $following->following->name }}</a>
                </div>

                <div class="col-auto text-end">
                    @if ($following->following->id != Auth::user()->id)
                      
                        <form action="{{ route('follow.destroy', $following->following->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                        class="border-0 bg-transparent p-0 text-danger btn-sm">Unfollow</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>

@else
<h3 class="text-muted text-center">No Followings Yet.</h3>

@endif



</div>

@endsection
