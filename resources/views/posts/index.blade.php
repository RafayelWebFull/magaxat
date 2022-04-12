@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">All Posts</div>
            <div class="card-body">
                <a href="{{ route('posts.create') }}" class="btn btn-success">Add New Post</a>
                <tabel class="table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <form action="">
                                        @csrf
                                        @method('DELETE')
                                        <buttom class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </tabel>
                <ul class="list-group">
                    @foreach($posts as $post)
                        <li class="list-group-item">{{ $post->title }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>

@endsection