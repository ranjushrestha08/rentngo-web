@extends('adminlte::page')

@section('title', 'Vehicles')


@section('content')
    <div class="container-fluid py-2">
        <div class="card">
            <div class="card-header">
                <h2>Vehicle Details</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="vehicle_name">Vehicle Name:</label>
                    <p>{{ $vehicle->vehicle_name }}</p>
                </div>
                <div class="form-group">
                    <label for="fuel_type">Fuel Type:</label>
                    <p>{{ $vehicle->fuel_type }}</p>
                </div>
                <div class="form-group">
                    <label for="model">Model:</label>
                    <p>{{ $vehicle->model }}</p>
                </div>
                <div class="form-group">
                    <label for="cost_per_hour">Cost per Hour:</label>
                    <p>{{ $vehicle->cost_per_hour }}</p>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    @if($vehicle->image_url)
                        <img src="{{ asset($vehicle->image_url) }}" alt="Vehicle Image" style="max-width: 200px;">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="vehicle_description">Vehicle Description:</label>
                    <p>{{ $vehicle->vehicle_description }}</p>
                </div>
                <div class="form-group">
                    <label for="vehicle_category">Vehicle Category:</label>
                    <p>{{ $vehicle?->category?->name }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
