<!-- resources/views/auth/verify-otp.blade.php -->
@extends('layouts.app-layout')

@section('content')
    <div class="container">
        <h2 class="text-center">Verify OTP</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3">
                <input type="text" class="form-control" name="otp" required>
            </div>

            <button type="submit" class="btn btn-primary">Verify OTP</button>
        </form>
    </div>
@endsection
