@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the videos page of magaxat.com where you can see all the uploaded videos">
@endsection
@section('title')
Magaxat | Videos
@endsection
@section('content')
<div class="videos-wrapper">
  <div class="videos-container">
    @foreach($videos as $video)
      <div class="video-wrapper">
        <div class="video-user-date-wrapper">
          <div class="video-user-info">
            <div class="video-user-image-wrapper">
              <img src="{{ $video->user->image !== null ? $video->user->image : asset('images/avatar.png') }}" alt="person" />
            </div>
            <div class="video-user-names-wrapper">
              <span class="video-user-name">
              <a href="{{ route('user.page', $video->user->unique_id) }}">
                {{ $video->user->name }}
              </a> 
              </span>
              <span class="video-user-link">@ 
                <a href="{{ route('user.page', $video->user->unique_id) }}">
                  {{ $video->user->name }}
                </a> 
              </span>
            </div>
          </div>
          <div class="video-date-wrapper">
            <span class="video-date">{{ $video->created_at->format('Y-m-d') }}</span>
            <span class="video-time">{{ $video->created_at->format('H:ia') }}</span>
          </div>
        </div>
        <div class="video-image-wrapper videos-one-item">
          <a href="{{ route('show-video', $video->id) }}">
            <video src="{{ $video->video_path }}" class="video-image" alt="{{ $video->video_path }}"></video>
            <div class="play-wrapper">
              <img src="{{ asset('images/img/play.png') }}" alt="">
            </div>
          </a>
        </div>
        <p class="video-title">
          {{ $video->title }}
        </p>
      </div>
    @endforeach
  </div>
</div>
@endsection