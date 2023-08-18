<div class="modal fade" id="like-post-{{ $post->id }}">
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
                   {{ $post->id }}
                </div>
            </div>

        </div>
    </div>
</div>

