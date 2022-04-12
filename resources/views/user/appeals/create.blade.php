@extends('layouts.front.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card profile-card">
            <div class="card-header">@lang('translations.add_appeal')</div>
            <div class="card-body">
               <form action="{{ route('user.appeals.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">@lang('translations.title')</label>
                        <input type="text" class="form-control" name="appeal_title" placeholder="Title">
                        @error('title')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">@lang('translations.descriptions')</label>
                        <textarea name="appeal_description" class="form-control" id="description" cols="30" rows="10"></textarea>
                        @error('description')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">@lang('translations.image')</label>
                        <input type="file" class="form-control" name="appeal_image">
                        @error('image')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="video">@lang('translations.video')</label>
                        <input type="file" class="form-control" name="appeal_video">
                        @error('video')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('translations.create_appeal')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
