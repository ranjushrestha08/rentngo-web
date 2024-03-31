@extends('adminlte::page')

@section('title', 'Vehicle Categories')

@section('content')
    <div class="container-fluid py-2">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card w-100">
            <div class="card-header">
                <h2>Create Vehicle Category</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('vehicleCategories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="text-muted">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

        </div>
    </div>
@endsection
