@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Add New Post</div>
            <div class="card-body">
               <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                        @error('title')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                        @error('description')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="video">Video</label>
                        <input type="file" class="form-control" name="video">
                        @error('video')
                        {{$message}}
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection