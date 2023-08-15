@extends('layouts.app')

@section('title','Admin: Users')
@section('content')

<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="small table-success text-secondary">
        <tr>
            <th></th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>CREATED_AT</th>
            <th>STATUS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($all_users as $user)
          <tr>
            <td>
                @if ($user->avatar)
                  <img src="{{ $user->avatar }}" alt=" {{ $user->avatar }}"
                  class="rounded-circle d-block mx-auto avatar-md">
                @else
                 <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                @endif
            </td>
            <td>
                <a href="{{ route('profile.show',$user->id) }}"
                    class="text-decoration-none text-dark fw-bold">{{ $user->name}}</a>
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                @if ($user->trashed())
                <i class="fa-regular fa-circle text-secondary me-1"></i>Inactive
                @else
                <i class="fa-solid fa-circle text-success me-1"></i>Active
                @endif

            </td>
            <td>
                @if (Auth::user()->id !== $user->id)
                <div class="dropdown">
                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>

                    <div class="dropdown-menu">
                        @if ($user->trashed())
                        <button class="dropdown-item"
                        data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                            <i class="fa-solid fa-user-check me-1"></i>activate {{ $user->name }}
                        </button>
                        @else
                        <button class="dropdown-item text-danger"
                        data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $user->id }}">
                            <i class="fa-solid fa-user-slash me-1"></i>Deactivate {{ $user->name }}
                        </button>
                        @endif

                    </div>
                </div>
                {{-- modal later --}}
                @include('admin.users.modal.status')

                @endif
            </td>
          </tr>

        @empty

        @endforelse
    </tbody>
</table>
{{-- pagination --}}
<div class="d-flex justify-content-center">
    {{ $all_users->links() }}
</div>

@endsection

