@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Add New Type</div>
            <div class="card-body">
               <form action="{{ route('admin.interesting-types.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value={{ old('name') }}>
                        @error('name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Type</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection