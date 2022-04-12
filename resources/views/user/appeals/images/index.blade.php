@extends('layouts.front.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card profile-card">
            <div class="card-header">All Appeals</div>
            <div class="card-body">
                <a href="{{ route('user.appeal-images.create', $appeal->id) }}" class="btn btn-success mb-3">Add New Image</a>
                <table class="table">
                    <thead>
                        <tr>
                            <td>title</td>
                            <td>image</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appeal_images as $image)
                            <tr>
                                <td>{{ $image->title }}</td>
                                <td><img src="{{ $image->image_path }}" width="150px" height="100px"></td>
                                <td style="">
                                    <a href="{{ route('user.appeal-images.edit', [$appeal->id, $image->id]) }}" class="btn btn-warning mb-3">Edit</a>
                                    <form action="{{ route('user.appeal-images.delete', [$appeal->id, $image->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection