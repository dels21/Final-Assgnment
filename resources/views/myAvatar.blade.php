@extends('layout.navbar')

@section('title', __('avatar.title'))
@section('activeMyAvatar', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container">
        <h3 style="color: white">{{ __('avatar.title') }}</h3>
        <div class="row mt-4">
            @forelse ($dataAvatar as $avatar)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $avatar->image_path) }}" alt="{{ $avatar->name }}'s image"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $avatar->name }}</h5>
                            <p class="card-text">{{ __('avatar.price', ['price' => number_format($avatar->price, 2)]) }}</p>
                            <form method="POST" action="{{ route('user-avatar.update-profile', $avatar->id) }}"
                                class="mt-auto">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="btn btn-primary w-100">{{ __('avatar.set_as_profile') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>{{ __('avatar.no_avatars') }}</p>
            @endforelse
        </div>
    </div>
@endsection
