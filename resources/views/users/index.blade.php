@extends('adminlte::page')

@section('title', 'Users')

@section('content')
    <div class="container-fluid py-3">
        <div class="d-flex w-100">
            <div class="card w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>Users</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->status ?? 'Not Verified' }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}"
                                           class="btn btn-outline-success">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary">Edit</a>
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
