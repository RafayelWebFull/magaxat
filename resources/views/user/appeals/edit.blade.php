@extends('layouts.front.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card profile-card">
            <div class="card-header">@lang('translations.edit_appeal'): <strong>{{ $appeal->title }}</strong></div>
            <div class="card-body">
               <form action="{{ route('user.appeals.update', $appeal->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">@lang('translations.title')</label>
                        <input type="text" class="form-control" name="appeal_title" placeholder="Title" value="{{ $appeal->title }}">
                        @error('title')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">@lang('translations.description')</label>
                        <textarea name="appeal_description" class="form-control" id="description" cols="30" rows="10">{{ $appeal->description }}</textarea>
                        @error('description')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">@lang('translations.image')</label>
                        <div>
                            <img src="{{ $appeal->image_path }}" class="mb-3" alt="" width="200px" height="100px">
                        </div>
                        <input type="file" class="form-control" name="appeal_image">
                        @error('image')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="video">@lang('translations.video')</label>
                        <div>
                            <video src="{{ $appeal->video_path }}" controls class="mb-3" width="200px" height="100px"></video>
                        </div>
                        <input type="file" class="form-control" name="appeal_video">
                        @error('video')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('translations.upd_appeal')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
