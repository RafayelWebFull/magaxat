@extends('layouts.front.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card profile-card">
            <div class="card-header">@lang('translations.all_appeals')</div>
            <div class="card-body">
                {{-- <a href="{{ route('user.appeals.create') }}" class="btn btn-success mb-3">@lang('translations.add_appeal')</a> --}}
                <table class="table">
                    <thead>
                        <tr>
                            <td>@lang('translations.title')</td>
                            <td>@lang('translations.action')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($my_appeals as $appeal)
                            <tr>
                                <td>{{ $appeal->title }}</td>
                                <td style="display:flex; justify-content:space-between">
                                    <a href="{{ route('user.appeals.edit', $appeal->id) }}" class="btn btn-warning mr-3">Edit</a>
                                    <a href="{{ route('user.appeal.images', $appeal->id) }}" class="btn btn-primary mr-3">Images</a>
                                    <form action="{{ route('user.appeals.delete', $appeal->id) }}" method="POST">
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
