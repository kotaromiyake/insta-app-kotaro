@extends('layouts.app')

@section('title','Admin: Seaech Posts')
@section('content')

<form action="{{ route('admin.posts.search') }}" style="width: 300px">
    <input type="search" name="search"
    class="form-control " placeholder="Search..."> </form>

<table class="table table-hover align-middle bg-white border text-secondary mt-3">
    <thead class="small table-danger text-secondary">
        <tr>
            <th></th>
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>LIKES</th>
            <th>CREATED_AT</th>
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
            <td>
                <i class="fa-solid fa-heart text-danger"></i> {{ $post->likes->count() }}
            </td>
            <td>{{ $post->created_at }}</td>
            <td>
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
                {{-- modal later --}}
                @include('admin.posts.modal.status')
                @include('users.posts.contents.modals.delete')
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
