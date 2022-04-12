@extends('layouts.auth')
@section('title') @lang('translations.login') @endsection
@section('content')
<div class="login-container">
    <div class="login-wrapper">
      <div class="login-titles">
        <p class="login-l-heading">Welcome Back</p>
        <p class="login-m-heading">Login</p>
      </div>

      <div class="login-form-wrapper">
        <form action="{{ route('login') }}" method="POST">
            @csrf
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              class="login-email-input"
              name="email"
              placeholder="Email"
            />
            @error('email')
                <span class="auth-error-message">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Password</label>
            <input
              type="password"
              class="login-password-input"
              name="password"
              placeholder="Password"
            />
          </div>
          <a class="forget-password-link" href="{{ route('password.request') }}">{{ __('translations.forgot-password') }}</a>
          <button class="login-button" type="submit">{{ __('translations.login') }}</button>
          <p>or</p>
          <a href="{{ route('register') }}" class="login-goto-sign-in">{{ __('translations.sign') }}</a>
        </form>
      </div>
    </div>
</div>

@push('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/getCountries.js') }}"></script>
@endpush
@endsection
