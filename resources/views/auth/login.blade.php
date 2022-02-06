@extends('base')

@section('content')
<h1 class="mt-3 mb-2">Log In</h1>

@error('credentials')
<div class="alert alert-danger">
    {{ $message }}
</div>
@enderror

<form action="{{ url('auth/login') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" aria-describedby="validationServerUsernameFeedback" required>
        @error('username')
        <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="validationServerPasswordFeedback" required>
        @error('password')
        <div id="validationServerPasswordFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

<div class="mt-3">
    <p>Don't have an account? <a href="{{ url('auth/signup') }}">Sign up!</a></p>
</div>

@endsection