@extends('layouts.app')

@section('title','Admin: Posts')
@section('content')

<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="small table-primary text-secondary">
        <tr>
            <th></th>
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>CREATED_AT</th>
            <th>STATUS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($all_posts as $post)
          <tr>
            <td>{{ $post->id }}</td>
            <td>
                <a href="{{ route('post.show',$post->id) }}">
                    @if ($post->image)
                    <img src="{{ $post->image }}" alt=" {{ $post->image }}"
                    class="mx-auto d-block img-lg">
                  @else
                   <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                  @endif
                </a>

            </td>
            <td>
                @forelse ($post->categoryPost as $category_post)
            <div class="badge bg-secondary bg-opacity-50">
                {{ $category_post->category->name }}
            </div>
            @empty
              <div class="badge bg-dark text-wrap">
                Uncategorized
              </div>
            @endforelse
            </td>
            <td>
                <a href="{{ route('profile.show',$post->user->id) }}" class="text-decoration-none text-dark fw-bold">
                    {{ $post->user->name }}
                </a>
            </td>
            <td>{{ $post->created_at }}</td>
            <td>
                @if ($post->trashed())
                <i class="fa-solid fa-circle-minus text-secondary me-1"></i>Hidden
                @else
                <i class="fa-solid fa-circle text-primary me-1"></i>Visible
                @endif

            </td>
            <td>
                {{-- @if (Auth::user()->id !== $post->user->id) --}}
                <div class="dropdown">
                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>

                    <div class="dropdown-menu">
                        @if ($post->trashed())
                        <button class="dropdown-item"
                        data-bs-toggle="modal" data-bs-target="#unhide-post-{{ $post->id }}">
                            <i class="fa-solid fa-user-check me-1"></i>Visible {{ $post->id }}
                        </button>
                        @else
                        <button class="dropdown-item text-danger"
                        data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                            <i class="fa-solid fa-user-slash me-1"></i>Hidden {{ $post->id }}
                        </button>
                        @endif

                    </div>
                </div>
                {{-- modal later --}}
                @include('admin.posts.modal.status')

                {{-- @endif --}}
            </td>
          </tr>

        @empty

        @endforelse
    </tbody>
</table>
{{-- pagination --}}
<div class="d-flex justify-content-center">
    {{ $all_posts->links() }}
</div>

@endsection
