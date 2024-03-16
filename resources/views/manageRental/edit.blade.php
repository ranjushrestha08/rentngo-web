@extends('adminlte::page')

@section('title', 'Edit Rental')

@section('content_header')
    <h1>Edit Rental</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="rental_status">Rental Status</label>
                            <select name="rental_status" id="rental_status" class="form-control">
                                <option value="pending" {{ $rental->rental_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="ongoing" {{ $rental->rental_status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ $rental->rental_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="canceled" {{ $rental->rental_status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
