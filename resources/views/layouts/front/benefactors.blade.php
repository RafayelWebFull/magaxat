@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the benefactors page in magaxat.com">
@endsection
@section('content')
<div class="navbar-background-wrapper"></div>
  <div class="benefactors-wrapper">
    <div class="search-benefactors-wrapper">
      <div class="search-container">
        <form class="search-benefactors-form" action="{{ route('all-benefactors') }}" method="GET">
          <div class="form-group">
            <input
              type="text"
              name="benefactor-name"
              class="benefactors-search-input"
              placeholder="{{ __('translations.search') }}"
            />
            <i class="fas fa-search search-benefactors-icon"></i>
          </div>
        </form>
      </div>
    </div>
    <div class="benefactors-container">
      @foreach($benefactors as $benefactor)
        <div class="single-benefactors-wrapper">
          <div class="single-benefactors-image-wrapper">
            <a href="{{ route('user.page', $benefactor->unique_id) }}">
              <img src="{{ $benefactor->image ?? asset('images/avatar.png') }}" alt="benefactors-image" />
            </a>
          </div>
          <div class="single-benefactors-info-wrapper">
            <div class="single-benefactors-title-desc-container">
              <span class="single-benefactors-title">
                <a href="">{{ $benefactor->name }}</a>
              </span>
              <span class="single-benefactors-description">
                <a href="">@ {{ $benefactor->name }}</a>
              </span>
            </div>
            <div class="single-benefactors-view-button-wrapper">
            @if(Auth::check())
              @if(Auth::user()->subscribed($benefactor->unique_id))
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
                <form action="{{ route('subscribe', $benefactor->unique_id) }}" method="POST">
                  @csrf
                  <button class="main-video-user-subscribed-link">
                    {{ __('translations.subscribe') }}
                  </button>
                </form>
              </div>
              @endif
            @endif
              {{-- <a href="" class="benefactors-message-link"
                ><i class="fa-regular fa-comment"></i>Message</a
              > --}}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
