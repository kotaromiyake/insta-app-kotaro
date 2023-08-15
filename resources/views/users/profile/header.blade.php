<div class="row">
    <div class="col-4">
        @if ($user->avatar)
          <img src="{{ $user->avatar }}" alt="{{ $user->avatar }}"
            class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
        @else
          <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif

    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>
            <div class="col-auto ps-2">
                @if (Auth::user()->id === $user->id)
                <a href="{{ route('profile.edit',$user->id) }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>

                @else

               @if ( $user->isFollowed())
               <form action="{{ route('follow.destroy',$user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Unfollow</button>
            </form>

               @else
               <form action="{{ route('follow.store',$user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
            </form>

               @endif


                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show',$user->id) }}" class="text-decoration-none text-dark">
                    <strong class="me-1">{{ $user->posts->count() }}</strong>Post
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
                    <strong class="me-1">{{ $user->followers->count() }}</strong>Follower{{ $user->followers->count()>1 ? 's' : '' }}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.followings', $user->id) }}" class="text-decoration-none text-dark">
                    <strong class="me-1">{{ $user->following->count() }}</strong>Following{{ $user->following->count()>1 ? 's' : '' }}
                </a>
            </div>
        </div>
        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>
