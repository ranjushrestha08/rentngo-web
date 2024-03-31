@extends('adminlte::page')

@section('title', 'Edit User')


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
                <h2>Edit User</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="verified" {{ $user->status === 'verified' ? 'selected' : '' }}>Verified</option>
                            <option value="not verified" {{ $user->status === 'not verified' ? 'selected' : '' }}>Not Verified</option>
                        </select>
                        <input type="hidden" name="original_status" value="{{ $user->status }}">                        </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>

        </div>
    </div>

@stop
