@extends('adminlte::page')

@section('title', 'User Details')

@section('content_header')
    <h1>User Details</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <p>{{ $user->name ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <p>{{ $user->email ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <p>{{ $user->phone ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <p>{{ $user->address ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <label for="license_no">License Number:</label>
                    <p>{{ $user->license_no ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <label for="citizenship_no">Citizenship Number:</label>
                    <p>{{ $user->citizenship_no ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <p>{{ $user->role ?? 'N/A' }}</p>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <p>{{ $user->status ? $user->status : 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
