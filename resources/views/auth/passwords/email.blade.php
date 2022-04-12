@extends('layouts.auth')
@section('title') Magaxat | Forget Password @endsection
@section('content')
<div class="login-container">
    <div class="login-wrapper">
      <div class="login-form-wrapper">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            @lang('translations.reset-success')
        </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              class="login-email-input"
              name="email"
              placeholder="email"
            />
            @error('email')
                <span class="auth-error-message">{{ $message }}</span>
            @enderror
          </div>
  
          <button type="submit">Reset</button>
        </form>
      </div>
    </div>
</div>
@endsection
