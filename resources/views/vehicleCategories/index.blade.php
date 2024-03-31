@extends('adminlte::page')

@section('title', 'Vehicle Categories')


@section('content')
    <div class="container-fluid py-3">
        <div class="d-flex w-100">
            <div class="card w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>Vehicle Categories</h4>
                        <a class="btn btn-primary" href="{{route('vehicleCategories.create')}}">+ ADD NEW</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a class="btn btn-outline-success mx-1" href="{{ route('vehicleCategories.show', $category->id) }}">View</a>
                                        <a class="btn btn-outline-primary mx-1" href="{{ route('vehicleCategories.edit', $category->id) }}">Edit</a>
                                        <form action="{{ route('vehicleCategories.destroy', $category->id) }}"
                                              method="POST"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger "
                                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                                Delete
                                            </button>
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
    </div>

@stop
