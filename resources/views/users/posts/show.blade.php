@extends('layouts.app')

@section('title','Show Post')
@section('content')

  <div class="row border shadow">
    <div class="col p-0 border-end">
        <img src="{{ $post->image }}" alt="{{ $post->image }}" class="w-100">
    </div>
    <div class="col-4 p-0 bg-white">
        <div class="card border-0">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('profile.show',$post->user->id) }}">
                            @if ($post->user->avatar)
                            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->avatar }}"
                            class="rounded-circle avatar-sm">
                            @else
                            <i class="fa-solid fa-circle-user text-secondary icon-sm" ></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0">
                        <a href="{{ route('profile.show',$post->user->id) }}"
                            class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                    </div>
                    <div class="col-auto">
                       @if (Auth::user()->id === $post->user->id)
                           {{-- if the owner of the post --}}
                           <div class="dropdown">
                            <button type="button" data-bs-toggle="dropdown" class="btn btn-sm shadow-none">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            <div class="dropdown-menu">
                                <a href="{{ route('post.edit',$post->id) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-1"></i>Edit</a>

                                <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                data-bs-target="#delete-post-{{ $post->id }}"><i class="fa-regular fa-trash-can me-1"></i>Delete</button>
                            </div>
                           </div>
                           @include('users.posts.contents.modals.delete')
                       @else
                            {{-- if not the owner show follow/unfpllow button --}}

                            {{-- unfollow --}}
                            <form action="{{ route('follow.destroy',$post->user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border-0 bg-transparent p-0 text-danger">Unfollow</button>
                            {{-- follow --}}

                        </form>

                       @endif

                        </div>
                    </div>
                </div>


            <div class="card-body w-100">
                {{-- heart + no like + categories --}}
                <div class="row align-items-center">
                    <div class="col-auto">
             @if ($post->isLiked())
            <form action="{{ route('like.destroy',$post->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm shadow-none p-0">
                    <i class="fa-solid fa-heart text-danger"></i>
                </button>
            </form>

            @else
            <form action="{{ route('like.store',$post->id) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-sm shadow-none p-0">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>

            @endif
                    </div>
                    <div class="col-auto px-0">
                        <span>{{ $post->likes->count() }}</span>
                    </div>
                    <div class="col text-end">
                        @forelse ($post->categoryPost as $category_post)
            <div class="badge bg-secondary bg-opacity-50">
                {{ $category_post->category->name }}
            </div>
            @empty
              <div class="badge bg-dark text-wrap">
                Uncategorized
              </div>
            @endforelse
                    </div>
                </div>

            {{-- owner + description --}}
            <a href="{{ route('profile.show',$post->user->id) }}"
                class="text-decoration-none text-dark fw-bold">
                {{ $post->user->name }}
            </a>
            <p class="d-inline fw-light">{{ $post->description}}</p>
            <p class="text-uppercase text-muted xsmall">{{ $post->created_at->diffForHumans() }}</p>
            {{-- diffForHumans - 2 minutes ago, 1 hour ago  --}}

            {{-- comments here soon --}}
             {{-- comment form --}}
            <form action="{{ route('comment.store',$post->id) }}" method="POST" class="mt-4">
                @csrf

                <div class="input-group">
                    <textarea name="comment_body{{ $post->id }}" id=""
                        rows="1" class="form-control" placeholder="Add a comment...">{{ old('comment_body' . $post->id) }}</textarea>
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                </div>
                {{-- error --}}
                @error('comment_body' . $post->id)
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </form>
            {{-- show all comments --}}
            {{-- check if post has comments --}}
            @if ($post->comments->isNotEmpty())
            <ul class="list-group mt-2">
                @foreach ($post->comments as $comment)
                <li class="list-group-item border-0 p-0 mb-2">
                    <a href="{{ route('profile.show',$comment->user->id) }}"
                        class="text-decoration-none text-dark fw-bold me-1">
                        {{ $comment->user->name }}
                    </a>
                    <p class="d-inline fw-light">{{ $comment->body }}</p>

                    <form action="{{ route('comment.destroy',$comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <span class="text-uppercase text-muted xsmall">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>

                        @if (Auth::user()->id === $comment->user->id)
                          &middot;
                          <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>

                        @endif
                    </form>
                </li>

                @endforeach
            </ul>

            @endif

            </div>
        </div>
    </div>
  </div>


@endsection


