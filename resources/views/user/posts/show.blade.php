@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Post: {{ $post->title }}</div>
            <div class="card-body">
                <div class="post">
                    <div class="post-title">
                        <label for="title">Post Title</label>
                        <p>{{ $post->title }}</p>
                    </div>
                    <div class="post-description">
                        <label for="title">Post Description</label>
                        <p>{{ $post->description }}</p>
                    </div>
                    <div class="post-image">
                        <label for="title">Post Image</label>
                        <img src="{{ $post->image_path }}" alt="">
                    </div>
                    <div class="post-title">
                        <label for="title">Post Video</label>
                        <video src="{{ $post->video_path }}"></video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection