@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">All Types</div>
            <div class="card-body">
                <a href="{{ route('admin.interesting-types.create') }}" class="btn btn-success mb-3">Add New Type</a>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interesting_types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td style="display:flex;">
                                    <a class="btn btn-warning" style="margin-right:10px"  href="{{ route('admin.interesting-types.edit', $type->id) }}">Edit</a>
                                    <form action="{{ route('admin.interesting-types.destroy', $type->id) }}" method="POST">
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