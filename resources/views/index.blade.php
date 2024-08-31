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
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent'))
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
        @endif
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
    
</section>

@endsection