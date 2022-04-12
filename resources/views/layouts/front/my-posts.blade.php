@extends('layouts.front.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">@lang('translations.all_post')</div>
            <div class="card-body">
                {{-- <a href="{{ route('user.posts.create') }}" class="btn btn-success mb-3">@lang('translations.add_n_post')</a> --}}
                <table class="table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($my_posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td style="display:flex;justify-content:space-between">
                                    <a href="{{ route('user.posts.edit', $post->id) }}" class="btn btn-warning mr-3">@lang('translations.edit')</a>
                                    <form action="{{ route('user.posts.delete', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">@lang('translations.delete')</button>
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
