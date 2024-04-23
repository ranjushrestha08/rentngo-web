@extends('adminlte::page')

@section('title', 'Edit Rental')

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
                <h2>Manage Rental</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="text" class="form-control" id="start_date" name="start_date"
                               value="{{ $rental->start_date }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="text" class="form-control" id="end_date" name="end_date"
                               value="{{ $rental->end_date }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="vehicle_id">Vehicle:</label>
                        <input type="text" class="form-control" id="vehicle_id" name="vehicle_id"
                               value="{{ $rental?->vehicle?->vehicle_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="user_id">User:</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                               value="{{ $rental?->user?->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Drop Location:</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                               value="{{ $rental->dropLocation->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Pickup Location:</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                               value="{{ $rental->dropLocation->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_cost">Total Cost:</label>
                        <input type="text" class="form-control" id="total_cost" name="total_cost"
                               value="{{ $rental->total_cost }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="rental_status">Rental Status</label>
                        <select name="rental_status" id="rental_status" class="form-control">
                            <option value="pending" {{ $rental->rental_status === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="ongoing" {{ $rental->rental_status === 'ongoing' ? 'selected' : '' }}>
                                Ongoing
                            </option>
                            <option value="completed" {{ $rental->rental_status === 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                            <option value="canceled" {{ $rental->rental_status === 'canceled' ? 'selected' : '' }}>
                                Canceled
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>

        </div>
    </div>
@stop
