@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid py-2">
        <div class="d-flex">
            <h2>Welcome back, {{auth()->user()->name}}</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totalUsers}}</h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('users.index')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$totalOrders}}</h3>
                        <p>Total Rental Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('rentals.index')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$totalVehicles}}</h3>
                        <p>Total Vehicles</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-list"></i>
                    </div>
                    <a href="{{route('vehicles.index')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$totalVehicleCategory}}</h3>
                        <p>Total Vehicle Category</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-warning"></i>
                    </div>
                    <a href="{{route('vehicleCategories.index')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <h4>Upcoming Rentals</h4>
        <div class="d-flex">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Drop Location</th>
                                <th>Pick Location</th>
                                <th>Vehicle </th>
                                <th>User</th>
                                <th>Total Cost</th>
                                <th>Rental Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rentals as $rental)
                                <tr>
                                    <td>{{ $rental->id }}</td>
                                    <td>{{ $rental->start_date }}</td>
                                    <td>{{ $rental->end_date }}</td>
                                    <td>{{ $rental->dropLocation?->address }}</td>
                                    <td>{{ $rental->pickLocation?->address }}</td>
                                    <td>{{ $rental->vehicle?->vehicle_name }}</td>
                                    <td>{{ $rental->user?->name }}</td>
                                    <td>{{ $rental->total_cost }}</td>
                                    <td>{{ $rental->rental_status }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@stop
