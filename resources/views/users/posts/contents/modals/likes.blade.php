<div class="modal fade" id="like-post-{{ $post->user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 modal-title text-warning">
                    Users who liked the post
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    @foreach ($post->likes as $like)
                    <div class="row align-items-center mb-3">
                      <div class="col-auto">
                          <a href="{{ route('profile.show',$like->user->id) }}">
                          @if ($like->user->avatar)
                          <img src="{{ $like->user->avatar }}" alt="{{ $like->user->avatar }}" class="rounded-circle avatar-sm">

                          @else
                          <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>

                          @endif</a>
                      </div>
                      <div class="col ps-0 text-truncate">
                          <a href="{{ route('profile.show',$like->user->id) }}"
                              class="fw-bold text-dark text-decoration-none">{{  $like->user->name }}</a>

                      </div>

                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

