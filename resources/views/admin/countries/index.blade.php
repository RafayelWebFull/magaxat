@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">All Countries</div>
            <div class="card-body">
                <a href="{{ route('admin.countries.create') }}" class="btn btn-success mb-3">Add New Country</a>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $country)
                            <tr>
                                <td>{{ $country->name }}</td>
                                <td style="display:flex">
                                    <a class="btn btn-warning" style="margin-right:10px" href="{{ route('admin.countries.edit', $country->id) }}">Edit</a>
                                    <form action="{{ route('admin.countries.destroy', $country->id) }}" method="POST">
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