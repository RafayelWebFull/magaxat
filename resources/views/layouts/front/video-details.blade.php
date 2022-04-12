@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the {{ $video->title }} main page">
@endsection
@section('title')
Magaxat | Video Details
@endsection
@section('content')
  <div class="main-video-wrapper">
    <div class="main-video-container">
      <div class="video-container">
        <video controls src="{{ $video->video_path }}" class="video" alt="video"></video>
        <div class="play-wrapper">
          <img src="{{ asset('images/img/play.png') }}" alt="">
        </div>
        <p class="main-video-description">
          {{ $video->videoable->title }}
        </p>
        <div class="main-video-user-date-wrapper">
          <div class="main-video-user-info">
            <div class="main-video-user-image-wrapper">
              <a href="{{ route('user.page', $video->user->unique_id) }}">
                <img src="{{ $video->user->image ?? asset('images/avatar.png') }}" alt="person" />
              </a>
            </div>
            <div class="main-video-user-names-wrapper">
              <span class="main-video-user-name">
               <a href="{{ route('user.page', $video->user->unique_id) }}">
                {{ $video->user->name }}
              </a>
              </span>
              <span class="main-video-user-link">@ 
                <a href="{{ route('user.page', $video->user->unique_id) }}">
                  {{ $video->user->name }}</span>
                </a>
            </div>
          </div>
          @if(Auth::check())
            @if(Auth::user()->subscribed($video->user->unique_id))
            <div class="main-video-date-wrapper">
              <form action="{{ route('unsubscribe', $video->user->unique_id) }}" method="POST">
                @csrf
                <button class="main-video-user-subscribed-link">
                  <i class="fas fa-check"></i> {{ __('translations.subscribed') }}
                </button>
              </form>
            </div>
            @else
            <div class="main-video-date-wrapper">
              <form action="{{ route('subscribe', $video->user->unique_id) }}" method="POST">
                @csrf
                <button class="main-video-user-subscribed-link">
                  {{ __('translations.subscribe') }}
                </button>
              </form>
            </div>
            @endif
          @endif
        </div>
      </div>
    </div>
    <div class="other-videos-container">
      @foreach($other_videos as $othervideo)
        <div class="other-video-container">
          <div class="other-video-image-wrapper">
            <a href="{{ route('show-video', $othervideo->id) }}">
              <video src="{{ $othervideo->video_path }}" class="other-video"></video>
              <div class="play-wrapper">
                <img src="{{ asset('images/img/play.png') }}" alt="">
              </div>
            </a>
          </div>
          <div class="other-video-user-date-wrapper">
            <div class="other-video-user-info">
              <div class="other-video-user-image-wrapper">
                <a href="{{ route('user.page', $othervideo->user->unique_id) }}">
                  <img src="{{ $othervideo->user->image ?? asset('images/avatar.png') }}" alt="person" />
                </a>
              </div>
              <div class="other-video-user-names-wrapper">
                <span class="other-video-user-name">
                  <a href="{{ route('user.page', $othervideo->user->unique_id) }}">
                    {{ $othervideo->user->name }}
                  </a>
                </span>
              <span class="other-video-user-link">@
                <a href="{{ route('user.page', $othervideo->user->unique_id) }}">
                  {{ $othervideo->user->name }}
                </a>
              </span>
              </div>
            </div>
            <div class="other-video-date-wrapper">
              <span class="video-date">{{ $othervideo->created_at->format('Y-m-d') }}</span>
              <span class="video-time">{{ $othervideo->created_at->format('H:ia') }}</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection