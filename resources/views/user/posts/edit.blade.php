@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">@lang('translations.edit_post'): <strong>{{ $post->title }}</strong></div>
            <div class="card-body">
               <form action="{{ route('user.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">@lang('translations.title')</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $post->title }}">
                        @error('title')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">@lang('translations.description')</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $post->description }}</textarea>
                        @error('description')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">@lang('translations.image')</label>
                        <div>
                            <img src="{{ $post->image_path }}" class="mb-3" alt="" width="200px" height="100px">
                        </div>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="video">@lang('translations.video')</label>
                        <div>
                            <video src="{{ $post->video_path }}" controls class="mb-3" width="200px" height="100px"></video>
                        </div>
                        <input type="file" class="form-control" name="video">
                        @error('video')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('translations.upd_post')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
