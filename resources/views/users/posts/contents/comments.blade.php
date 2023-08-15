
<div class="mt-3">
    {{-- show all comment --}}
    @if ($post->comments->isNotEmpty())
    <ul class="list-group mt-2">
        @foreach ($post->comments as $comment)
        <li class="list-group-item border-0 p-0 mb-2">
            <a href="{{ route('profile.show',$comment->user->id) }}" class="text-decoration-none text-dark fw-bold me-1">
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


    {{-- comment form --}}
    <form action="{{ route('comment.store',$post->id) }}" method="POST">
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
</div>
