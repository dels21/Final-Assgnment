@extends('layout.navbar')

@section('title', __('home.title'))
@section('activeHome', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container">
        <h3 style="color: white">{{ __('home.notifications') }}</h3>
        <div class="alert alert-info bg-warning border-0">
            <ul class="list-unstyled mb-0">
                @forelse (Auth::user()->notifications as $notification)
                    <li style="color: white">
                        {{ $notification->data['message'] }}
                        <a href="{{ route('notifications.destroy', $notification->id) }}" class="btn btn-danger btn-sm ms-2"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $notification->id }}').submit();">
                            {{ __('home.delete') }}
                        </a>

                        <form id="delete-form-{{ $notification->id }}"
                            action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </li>
                @empty
                    <li style="color: white">{{ __('home.no_notifications') }}</li>
                @endforelse
            </ul>
        </div>

        <div class="row mt-4">
            <!-- Search Form -->
            <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control"
                            placeholder="{{ __('home.search_placeholder') }}" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">{{ __('home.search_button') }}</button>
                    </div>
                </div>
            </form>

            @foreach ($dataUser as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $user->profile_path) }}" alt="{{ $user->name }}'s profile"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->fields_of_work }}</p>
                            <form method="POST" action="{{ route('friend-request.store') }}" class="mt-auto">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary w-100">{{ __('home.send_request') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
