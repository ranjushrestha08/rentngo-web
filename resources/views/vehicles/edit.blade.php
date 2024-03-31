@extends('adminlte::page')

@section('title', 'Vehicles')

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
                <h2>Edit Vehicle</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('vehicles.update', $vehicle->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="vehicle_name">Vehicle Name</label>
                        <input type="text" name="vehicle_name" id="vehicle_name" class="form-control"
                               value="{{old('vehicle_name', $vehicle->vehicle_name)}}">
                    </div>
                    <div class="form-group">
                        <label for="fuel_type">Fuel Type</label>
                        <select name="fuel_type" id="fuel_type" class="form-control">
                            <option value="Petrol" {{ $vehicle->fuel_type=='Petrol' ? 'selected' : '' }}>Petrol</option>
                            <option value="Diesel" {{ $vehicle->fuel_type=='Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Electric" {{ $vehicle->fuel_type=='Electric' ? 'selected' : '' }}>Electric
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" name="model" id="model" class="form-control"
                               value="{{ old('model',$vehicle->model) }}">
                    </div>
                    <div class="form-group">
                        <label for="cost_per_hour">Cost per Hour</label>
                        <input type="text" name="cost_per_hour" id="cost_per_hour" class="form-control"
                               value="{{ old('cost_per_hour', $vehicle->cost_per_hour) }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image_url" id="image_url" class="form-control">
                        @if($vehicle->image_url)
                            <img src="{{ asset($vehicle->image_url) }}" alt="Current Image" style="max-width: 200px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="vehicle_description">Vehicle Description</label>
                        <input type="text" name="vehicle_description" id="vehicle_description" class="form-control"
                               value="{{ old('description', $vehicle->vehicle_description) }}">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_category_id">Vehicle Category</label>
                        <select name="vehicle_category_id" id="vehicle_category_id" class="form-control">
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ $vehicle->vehicle_category_id==$category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Vehicle</button>
                </form>
            </div>
        </div>
    </div>

@endsection
