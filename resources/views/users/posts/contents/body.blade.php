{{-- clikable image --}}
<div class="container p-0">
    <a href="{{ route('post.show',$post->id) }}">
        <img src="{{ $post->image }}" alt="{{ $post->image}}" class="w-100">
    </a>
</div>
<div class="card-body bg-white p-2 mb-2">
    {{-- heart btn + no of likes --}}
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
            <button class="btn btn-link text-decoration-none"
            data-bs-toggle="modal" data-bs-target="#like-post-{{ $post->user->id }}">
            <span>{{ $post->likes->count() }}</span></button>
        </div>
        @include('users.posts.contents.modals.likes')
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
<a href="{{ route('profile.show',$post->user->id) }}" class="text-decoration-none text-dark fw-bold">
    {{ $post->user->name }}
</a>
<p class="d-inline fw-light">{{ $post->description}}</p>
<p class="text-uppercase text-muted xsmall">{{ $post->created_at->diffForHumans() }}</p>
{{-- diffForHumans - 2 minutes ago, 1 hour ago  --}}

{{-- comments here soon --}}
@include('users.posts.contents.comments')

</div>
