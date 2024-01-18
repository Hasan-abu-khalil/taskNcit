@extends('layout_user.user_master')


@section('title', 'Login')


@section('content')

<div class="login-container">
    <h2>Login</h2>

    @if (session('error'))
    <div class="alert">
        {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    <div class="m-3">
        <a  href="{{ route('auth.register') }}">Register</a>
    </div>


</div>
@endsection