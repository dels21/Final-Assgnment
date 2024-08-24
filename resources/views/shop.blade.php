@extends('layout.navbar')

@section('title', __('shop.title'))
@section('activeShop', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h3 style="color: white">{{ __('shop.title') }}</h3>
            <form method="POST" action="{{ route('user.addCoins') }}">
                @csrf
                <button type="submit" class="btn btn-warning">{{ __('shop.add_coins') }}</button>
            </form>
        </div>
        <div class="row mt-4">
            @forelse ($dataAvatar as $avatar)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $avatar->image_path) }}" alt="{{ $avatar->name }}'s image"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $avatar->name }}</h5>
                            <p class="card-text">{{ __('shop.price', ['price' => number_format($avatar->price, 2)]) }}</p>
                            <form method="POST" action="{{ route('user-avatar.store') }}" class="mt-auto">
                                @csrf
                                <input type="hidden" name="avatar_id" value="{{ $avatar->id }}">
                                <button type="submit" class="btn btn-primary w-100">{{ __('shop.buy_now') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>{{ __('shop.no_avatars') }}</p>
            @endforelse
        </div>
    </div>
@endsection
