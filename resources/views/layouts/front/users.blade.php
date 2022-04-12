@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the users page of magaxat.com">
@endsection
@section('title')
Magaxat | Users
@endsection
@section('content')
<div class="navbar-background-wrapper"></div>
<div class="users-wrapper">
  <div class="search-users-wrapper">
    <div class="search-users-container">
      <form class="search-users-form" action="{{ route('all-users') }}" method="GET">
        <div class="form-group">
          <input
            type="text"
            class="users-search-input"
            name="user-name"
            placeholder="{{ __('translations.search') }}"
          />
          <i class="fas fa-search search-users-icon"></i>
        </div>
      </form>
    </div>
    <div class="users-filter-icon">
      <div class="filter-icon-wrapper">
        <i class="fa-solid fa-filter"></i>
      </div>
    </div>
    <div class="users-filter-selects">
      <div class="filter-interest-select select-filter">
        <div class="select-inside">
          <span>{{ __('translations.interest') }}</span>
          <i class="fa-solid fa-angle-down"></i>
        </div>
        <div class="select-sub rm-select">
          @foreach($interesting_types as $type)
          <div class="sub-select-item">
            <div class="area-check">
              <label for="{{ $type->name }}"></label>
                <div class="round">
                  <input type="checkbox" id="{{ $type->name }}" /> 
                  <label for="{{ $type->name }}" class="sub-select-check"></label>
                </div>  
            </div>
            <a class="anchor" href="{{ route('all-users', array_merge(request()->query(), ['interesting-in-type' => $type->name])) }}">{{ $type->name }}</a>
          </div>
          @endforeach
        </div>
      </div>
      
      <div class="filter-gender-select select-filter">
        <div class="select-inside">
          <span>{{ __('translations.gender') }}</span>
          <i class="fa-solid fa-angle-down"></i>
        </div>
        <div class="select-sub rm-select">
          <div class="sub-select-item">
            <div class="area-check">
              <label for="male"></label>
                <div class="round">
                  <input name="" type="checkbox" id="male" class="sub-select-check"> 
                  <label for="male" class="sub-select-check"></label>
                </div>  
            </div>
            <a class="anchor" href="{{ route('all-users', array_merge(request()->query(), ['gender' => 'male'])) }}">{{ __('translations.male') }}</a>
          </div>
          <div class="sub-select-item">
            <div class="area-check">
              <label for="female"></label>
                <div class="round">
                  <input name="" type="checkbox" id="female" class="sub-select-check"> 
                  <label for="female" class="sub-select-check"></label>
                </div>  
            </div>
            <a class="anchor" href="{{ route('all-users', array_merge(request()->query(), ['gender' => 'female'])) }}">{{ __('translations.female') }}</a>
          </div>
        </div>
      </div>
      <div class="filter-interest-select select-filter">
        <div class="select-inside">
          <span>{{ __('translations.country') }}</span>
          <i class="fa-solid fa-angle-down"></i>
        </div>
        <div class="select-sub rm-select">
          @foreach($countries as $country)
          <div class="sub-select-item">
            <div class="area-check">
              <label for="{{ $country->name }}"></label>
                <div class="round">
                  <input name="" type="checkbox" id="{{ $country->name }}" class="sub-select-check"> 
                  <label for="{{ $country->name }}" class="sub-select-check"></label>
                </div>  
            </div>
            <a class="anchor" href="{{ route('all-users', array_merge(request()->query(), ['country' => $country->name ])) }}">{{ $country->name }}</a>
          </div>
          @endforeach
        </div>
      </div>

      
      
    </div>
  </div>
  <div class="users-container">
    @foreach($users as $user)
      <div class="single-user-wrapper">
        <div class="single-user-image-wrapper">
          <a href="{{ route('user.page', $user->unique_id) }}">
            <img src="{{ $user->image ?? asset('images/avatar.png') }}" alt="user-image" />
          </a>
        </div>
        <div class="single-user-info-wrapper">
          <div class="single-user-title-desc-container">
            <span class="single-user-title">
              <a href="">{{ $user->name }} </a>
            </span>
            <span class="single-user-description">
              <a href="">@ {{ $user->name }}</a>
            </span>
          </div>
          <div class="single-user-view-button-wrapper">
            @if(Auth::check())
              @if(Auth::user()->subscribed($user->unique_id))
              <div class="main-video-date-wrapper">
                <form action="{{ route('unsubscribe', $user->unique_id) }}" method="POST">
                  @csrf
                  <button class="main-video-user-subscribed-link">
                    <i class="fas fa-check"></i> {{ __('translations.subscribed') }}
                  </button>
                </form>
              </div>
              @else
              <div class="main-video-date-wrapper">
                <form action="{{ route('subscribe', $user->unique_id) }}" method="POST">
                  @csrf
                  <button class="main-video-user-subscribed-link">
                    {{ __('translations.subscribe') }}
                  </button>
                </form>
              </div>
              @endif
            @endif
            {{-- <a href="" class="user-message-link"
              ><i class="fa-regular fa-comment"></i>Message</a
            > --}}
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
