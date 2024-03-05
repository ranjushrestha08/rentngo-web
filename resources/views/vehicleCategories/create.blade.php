@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Vehicle Category</h2>
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
        <!-- //add form for vehicle category here -->
        <button type="submit" class="btn btn-primary">Create Vehicle</button>
    </form>
</div>
@endsection