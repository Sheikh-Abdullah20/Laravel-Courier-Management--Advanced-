@extends('layouts.app')

@section('title')
{{ Auth::user()->roles->pluck('name')->implode('') }} - Home
@endsection

@section('content')
<x-alert/>
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard</h2>
            <p>Whole data about your business here</p>
        </div>
    </div>
    <div class="row justify-content-center">
        @if(auth()->user()->hasRole('admin'))
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext align-content-center">
                    <span class="icon icon-sm rounded-circle bg-warning d-flex"><i class="text-secondary material-icons md-store" style="font-size: 2rem"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Agents</h6>
                        <span>{{ $agents->count() }}</span>
                       
                    </div>
                </article>
            </div>
        </div>
        @endif
       
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success"><i class="text-dark material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Shipments</h6>
                        <span>{{ $shipments->count() }}</span>
                       
                    </div>
                </article>
            </div>
        </div>
     
        @if(auth()->user()->hasRole('admin'))
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-secondary"><i class="text-light material-icons md-person"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Users</h6>
                        <span>{{ $users->count() }}</span>
                    </div>
                </article>
            </div>
        </div>
        @endif

        @if(auth()->user()->hasRole('admin'))
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-dark"><i class="text-warning material-icons md-directions_bike"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Riders</h6>
                        <span>{{ $riders->count() }}</span>
                    </div>
                </article>
            </div>
        </div>
        @endif
    </div>
    {{-- <div class="row">
        <div class="col-md-12">
            <h2 class="content-title card-title">Shipments Status</h2>
        </div>
    </div> --}}
    <hr>
    <div class="row my-2 justify-content-center">

        @foreach($statuss as $status)
        @if($status->status_name === 'Order Initiated')
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-secondary"><i class="text-info material-icons md-thumb_up"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">{{ $status->status_name }}</h6>
                        <span>{{ $statusCount[$status->status_name] ?? 0 }}</span>
                    </div>
                </article>
            </div>
        </div>
        @elseif($status->status_name === 'On the way')
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-dark"><i class="text-primary material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">{{ $status->status_name }}</h6>
                        <span>{{ $statusCount[$status->status_name] ?? 0 }}</span>
                    </div>
                </article>
            </div>
        </div>

        @elseif($status->status_name === 'Delivered')
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success"><i class="text-light material-icons md-check_circle"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">{{ $status->status_name }}</h6>
                        <span>{{ $statusCount[$status->status_name] ?? 0 }}</span>
                    </div>
                </article>
            </div>
        </div>
        @endif
        @endforeach

    </div>

    <div class="card mb-4">
        <article class="card-body">
            <h5 class="card-title">Shipment statistics</h5>
            <canvas id="myChart" height="120px"></canvas>
        </article>
    </div>
</section>

@endsection

@section('scripts')

<script>
    (function ($) {
    "use strict";

    /*Sale statistics Chart*/
    if ($('#myChart').length) {
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            
            // The data for our dataset
            data: {
                labels: ["Statuses"],
                datasets: [{
                        label: 'Order Initiated',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(44, 120, 220, 0.2)',
                        borderColor: 'rgba(44, 120, 220)',
                        data: [@json($chartStatusCountOrderInitiated)],
                    },
                    {
                        label: 'On the way out',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(4, 209, 130, 0.2)',
                        borderColor: 'rgb(4, 209, 130)',
                        data: [@json($chartStatusCountOntheway )],
                    },
                    {
                        label: 'Delivered',
                        tension: 0.3,
                        fill: true,
                        backgroundColor: 'rgba(380, 200, 230, 0.2)',
                        borderColor: 'rgb(380, 200, 230)',
                        data: [@json($chartStatusCountDelivered )],
                    }

                ]
            },
            options: {
                plugins: {
                legend: {
                    labels: {
                    usePointStyle: true,
                    },
                }
                }
            }
        });
    } 
})(jQuery);
</script>


@endsection