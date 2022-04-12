@extends('layouts.front.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card profile-card">
            <div class="card-header">@lang('translations.add_appeal')</div>
            <div class="card-body">
               <form action="{{ route('user.appeal-images.update', [$appeal->id, $image->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">@lang('translations.title')</label>
                        <input type="text" class="form-control" name="title" value="{{ $image->title }}">
                        @error('title')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">@lang('translations.image')</label>
                        <img src="{{ $image->image_path }}" width="150px" height="100px" alt="">
                        <input type="file" class="form-control" name="image">
                        @error('image')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('translations.add_img')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
