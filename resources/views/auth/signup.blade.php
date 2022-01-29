@extends('base')

@section('content')
<h1 class="mt-3 mb-2">Sign Up</h1>

<form action="{{ url('auth/signup') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" aria-describedby="validationServerUsernameFeedback">
        @error('username')
        <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="validationServerPasswordFeedback">
        @error('password')
        <div id="validationServerPasswordFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" aria-describedby="validationServerPasswordConfirmationFeedback">
        @error('password_confirmation')
        <div id="validationServerPasswordConfirmationFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
@endsection