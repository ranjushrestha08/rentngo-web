@extends('adminlte::page')

@section('title', 'Vehicle Categories')


@section('content')
    <div class="container-fluid py-2">
        <div class="card">
            <div class="card-header">
                <h2>Vehicle Category Details</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">Category Name: {{ $category->name }}</h5>
                <p class="card-text">Category ID: {{ $category->id }}</p>
                <a href="{{ route('vehicleCategories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('vehicleCategories.destroy', $category->id) }}" method="POST"
                      style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this category?')">Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
