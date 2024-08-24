@extends('layout.navbar')

@section('title', 'My Profile')
@section('activeMyProfile', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . Auth::user()->profile_path) }}"
                    alt="{{ Auth::user()->name }}'s profile picture" class="card-img-top img-fluid"
                    style="object-fit: cover; height: 250px;">
                    <div class="card-body">
                        <h3>{{ Auth::user()->name }}</h3>
                        <p class="card-text"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p class="card-text"><strong>Gender:</strong> {{ Auth::user()->gender }}</p>
                        <p class="card-text"><strong>Field of Work:</strong>
                            {{ Auth::user()->fields_of_work ?? 'Not specified' }}</p>
                        <p class="card-text"><strong>LinkedIn:</strong>
                            {{ Auth::user()->linkedin_username ?? 'Not linked' }}</p>
                        <p class="card-text"><strong>Mobile Number:</strong> {{ Auth::user()->mobile_number }}</p>
                        <p class="card-text"><strong>Coins:</strong> {{ Auth::user()->coins }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
