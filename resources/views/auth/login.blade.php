@extends('layouts.app-layout')

@section('content')
    <div class="container">
        <h2 class="text-center">Login</h2>

        <form method="POST" action="{{ url('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Google reCAPTCHA -->
            <div class="mb-3">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                @error('g-recaptcha-response') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

            <!-- Register Link -->
            <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </form>
    </div>

    <!-- Load reCAPTCHA script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection
