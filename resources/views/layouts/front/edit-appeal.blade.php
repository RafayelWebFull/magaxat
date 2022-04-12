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
                        @error('appeal_title')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">@lang('translations.description')</label>
                        <textarea name="appeal_description" class="form-control" id="description" cols="30" rows="10">{{ $appeal->description }}</textarea>
                        @error('appeal_description')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">@lang('translations.image')</label>
                        @if($appeal->image_path !== null)
                        <div>
                            <img src="{{ $appeal->image_path }}" class="mb-3" alt="" width="200px" height="100px">
                        </div>
                        @endif
                        <input type="file" accept="image/*" class="form-control" name="appeal_image[]">
                        @if($errors->has('appeal_image.*'))
                            @foreach($errors->get('appeal_image.*') as $error)
                            @foreach($error as $err)
                            <p style="color:red">{{$err}}</p>
                            @endforeach
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="video">@lang('translations.video')</label>
                        @if($appeal_video !== null)
                        <div>
                            <video src="{{ $appeal_video->video_path }}" controls class="mb-3" width="200px" height="100px"></video>
                        </div>
                        @endif
                        <input type="file" class="form-control" name="appeal_video">
                        @error('appeal_video')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                       <label class="create-post-label" for="video">@lang("translations.pdf")</label>
                        <input type="file" accept=".pdf" class="form-control" name="appeal_pdf">
                        @error('appeal_pdf')
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