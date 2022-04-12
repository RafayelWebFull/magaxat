@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">All Users</div>
            <div class="card-body">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Add New User</a>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Status</td>
                            <td>Type</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user::STATUSES[$user->status] }}</td>
                                <td>{{ $user->type }}</td>
                                <td style="display:flex">
                                    <form style="margin-right:10px" action="{{ $user->status === 1 ? route('admin.users.block', $user->id) : route('admin.users.unblock', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-warning">{{$user->status === 1 ? 'Block' : 'Unblock'}}</button>
                                    </form>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
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