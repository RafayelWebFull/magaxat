@extends('layouts.auth')
@section('title') Magaxat | Register @endsection
@section('content')

    {{-- <div class="r-god-container">
        <div class="r-super-container2">
            <div class="title-container mt-3">
                <h1>@lang('translations.acc_create')</h1>
            </div>

            <div class="form mt-5">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="input-div">
                        <label for="name"></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="@lang('translations.name')"/>
                    </div>
                    @error('name')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div">
                        <label for="email"></label>
                        <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="@lang('translations.e_mail')"/>
                    </div>
                    @error('email')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div password-group">
                        <label for="password"></label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="@lang('translations.password')"
                        />
                    </div>
                    @error('password')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div">
                        <input
                            id="phone_number"
                            type="text"
                            name="phone_number"
                            value="{{ old('phone_number') }}"
                            placeholder="@lang('translations.phone_numb')"
                        />
                    </div>
                    @error('phone_number')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="type-group">
                        <label for="type">@lang('translations.type')</label>
                        <div class="type-wrapper">
                            <input
                                type="radio"
                                class="user-type"
                                name="type"
                                id="benefactor"
                                value="benefactor"
                            />
                            <label for="benefactor" style="cursor: pointer">@lang('translations.benefac')</label>
                        </div>
                        <div class="type-wrapper">
                            <input
                                type="radio"
                                class="user-type"
                                name="type"
                                id="user"
                                value="user"
                            />
                            <label for="user" style="cursor: pointer">@lang('translations.user')</label>
                        </div>
                    </div>
                    @error('type')
                    <div class="input-error mt-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div interests-group interesting-types-group-div">
                        <label
                            for="types-list"
                            class="input-label interesting-types-label"
                        >@lang('translations.interest_area')</label>
                    </div>
                    @error('interesting_type')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    <div class="input-div additionals-group">
                        <label for="child-types" class="input-label child-types-label"
                        >@lang("translations.add_types")</label>

                        <select
                            name="additional_type"
                            class="child-types-select"
                            id="child-types-list"
                        >
                            <option value="" disabled selected>@lang('translations.select_type')</option>
                            <option value="individual">@lang('translations.individ')</option>
                            <option value="organisation">@lang('translations.org')</option>
                        </select>
                    </div>
                    @error('additional_type')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    <div class="input-div organisation-div">
                        <label for="organisation"
                               class="input-label organisation-label">@lang('translations.org_desc')</label>
                        <textarea name="organisation_description" class="organisation-input" id="organisation" cols="30"
                                  rows="10"></textarea>
                        @error('organisation_description')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="button">
                        <button class="custom-btn btn-7 mb-5"><span>@lang('translations.sign_up')</span></button>
                    </div>
                </form>
            </div>

        </div>
    </div> --}}

    <div class="register-container">
        <div class="register-wrapper">
          <div class="login-titles">
            <p class="login-l-heading">Welcome Back</p>
            <p class="login-m-heading">Sign in</p>
          </div>

          <div class="register-form-wrapper">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">First Name</label>
                            <input
                              type="text"
                              class="login-email-input"
                              name="name"
                              placeholder="Name"
                              value="{{ old('name') }}"
                            />
                            @error('name')
                                <span class="auth-error-message">{{ $message }}</span>
                            @enderror

                          </div>

                          <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input
                              type="text"
                              class="login-email-input"
                              name="last_name"
                              placeholder="Last name"
                              value="{{ old('last_name') }}"
                            />
                            @error('last_name')
                                <span class="auth-error-message">{{ $message }}</span>
                            @enderror
                          </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input
                              type="email"
                              class="login-email-input"
                              name="email"
                              placeholder="Email"
                              value="{{ old('email') }}"
                            />
                            @error('email')
                                <span class="auth-error-message">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="form-group col-md-6">
                            <label for="email">Type</label>
                            <select name="type" class="form-control login-email-input" id="type">
                                <option value="user">User</option>
                                <option value="benefactor">Benefactor</option>
                            </select>
                            @error('type')
                                <span class="auth-error-message">{{ $message }}</span>
                            @enderror
                          </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input
                              type="password"
                              class="login-email-input"
                              name="password"
                              placeholder="Password"
                            />
                            @error('password')
                                <span class="auth-error-message">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="form-group col-md-6 adds-type-row">
                            <label for="additional_type">Additional Type</label>
                            <select name="additional_type" class="form-control login-email-input" id="additional_type">
                                <option value="individual">Individual</option>
                                <option value="organisation">Organisation</option>
                            </select>
                            @error('additional_type')
                                <span class="auth-error-message">{{ $message }}</span>
                            @enderror
                          </div>
                    </div>
                </div>

                <div class="col-md-12 desc-row">
                    <div class="row">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="auth-error-message">{{ $message }}</span>
                            @enderror
                          </div>
                    </div>
                </div>

              <a class="forget-password-link mt-1 mb-3" href="{{ route('password.request') }}">Forget your password?</a>
              <button class="register-button" type="submit">{{ __('translations.sign') }}</button>
              <p>or</p>
              <a href="{{ route('login') }}" class="register-goto-login-in">{{ __('translations.login') }}</a>
            </form>
          </div>
        </div>
    </div>
@push('js')
<script src="{{ asset('js/authentication.js?version=1') }}"></script>
@endpush
@endsection
