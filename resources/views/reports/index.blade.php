@extends('layouts.app')

@section('title')
Reports
@endsection

@section('content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title">Reports</h2>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-body">
            {{-- <div class="row">
                <div class="col-md-6 text-center">
                    <h2>Status</h2>
                    @foreach($statuss as $status)
                    @if($status->status_name === 'Pending')
                    <p class="bg-danger p-3 rounded text-light">{{ $status->status_name }}</p>
                    @elseif($status->status_name === 'Approved')
                    <p class="bg-warning p-3 rounded text-dark">{{ $status->status_name }}</p>
                    @elseif($status->status_name === 'On the way')
                    <p class="bg-info p-3 rounded text-dark">{{ $status->status_name }}</p>
                    @elseif($status->status_name === 'Delivered')
                    <p class="bg-success p-3 rounded text-light">{{ $status->status_name }}</p>
                    @endif
                    @endforeach
                </div>
                <div class="col-md-6 text-center">
                    <h2>Status Count</h2>
                    <p class="p-3 bg-dark text-light rounded">{{ $Approved->count() }}</p>
                    <p class="p-3 bg-dark text-light rounded">{{ $pending->count() }}</p>
                    <p class="p-3 bg-dark text-light rounded">{{ $Delivered->count() }}</p>
                    <p class="p-3 bg-dark text-light rounded">{{ $Ontheway->count() }}</p>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-responsive table-striped text-center">
                        <thead>
                            <tr>
                                <th>Shipments Status</th>
                                <th>Shipments Status Count</th>
                            </tr>
                        </thead>
                        @foreach ($statuss as $status )

                        <tbody>
                            <tr>
                                <td>
                                    @if($status->status_name === 'Pending')
                                    <p class="bg-danger p-2 text-light"> {{ $status->status_name }}</p>

                                    @elseif($status->status_name === 'Approved')
                                    <p class="bg-success p-2 text-light"> {{ $status->status_name }}</p>

                                    @elseif($status->status_name === 'On the way')
                                    <p class="bg-primary p-2 text-light"> {{ $status->status_name }}</p>

                                    @elseif($status->status_name === 'Delivered')
                                    <p class="bg-warning p-2"> {{ $status->status_name }}</p>
                                    @else
                                    <p class="bg-secondary p-2"> {{ $status->status_name }}</p>
                                    @endif

                                </td>
                                <td>
                                    {{ $statusCount[$status->status_name] }}
                                </td>

                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-md-12">
                    <h2>Status Of Branch</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-responsive table-striped text-center">
                        <thead>
                            <tr>
                                <th>Branch Agent Name</th>
                                <th>Branch Name</th>
                                <th>Branch Status</th>
                            </tr>
                        </thead>
                        @foreach ($agents as $agent )
                        <tbody>
                            <tr>

                                <td>{{ $agent->owner_name }}</td>
                                <td>{{ $agent->branch_name }}</td>
                                <td>
                                    @if($agent->branch_status === 'Active')
                                    <p class="bg-success text-light p-2">{{ $agent->branch_status }}</p>
                                    @elseif($agent->branch_status === 'In-Active')
                                    <p class="bg-danger text-light p-2">{{ $agent->branch_status }}</p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection