@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Vehicle</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('vehicles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="fuel_type">Fuel Type</label>
            <select name="fuel_type" id="fuel_type" class="form-control">
                <option value="Petrol" {{ old('fuel_type')=='Petrol' ? 'selected' : '' }}>Petrol</option>
                <option value="Diesel" {{ old('fuel_type')=='Diesel' ? 'selected' : '' }}>Diesel</option>
                <option value="Electric" {{ old('fuel_type')=='Electric' ? 'selected' : '' }}>Electric</option>
                <!-- Add other fuel types as needed -->
            </select>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="{{ old('model') }}">
        </div>
        <div class="form-group">
            <label for="cost_per_hour">Cost per Hour</label>
            <input type="text" name="cost_per_hour" id="cost_per_hour" class="form-control"
                value="{{ old('cost_per_hour') }}">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
        </div>
        <div class="form-group">
            <label for="vehicle_category_id">Vehicle Category</label>
            <!-- Assuming you have a variable $categories containing the available categories -->
            <select name="vehicle_category_id" id="vehicle_category_id" class="form-control">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('vehicle_category_id')==$category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Vehicle</button>
    </form>
</div>
@endsection