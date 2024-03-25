@extends('adminlte::page')

@section('title', 'Vehicle Categories')

@section('content_header')
<h1>Vehicle Categories</h1>
@stop

@section('content')
<div class="container">
    <h2>Create Vehicle Category</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('vehicleCategories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
        <button type="submit" class="btn btn-primary">Create Vehicle Category</button>
    </form>
</div>
@endsection