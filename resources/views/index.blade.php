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
    
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table  text-center">
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
                                    
                                          <div class="card d-flex align-items-center  ">
                                            <p class=" p-2 text-dark d-flex text-center"> <i class="material-icons icon md-hourglass_empty"></i> {{ $status->status_name }}</p>
                                          </div>
        
                                            @elseif($status->status_name === 'Approved')
                                            <div class="card d-flex align-items-center  ">
                                                <p class=" p-2 text-dark d-flex text-center"> <i class="material-icons icon md-thumb_up mx-2 "></i> {{ $status->status_name }}</p>
                                              </div>
                                              
                                              @elseif($status->status_name === 'On the way')
                                              <div class="card d-flex align-items-center  ">
                                                  <p class=" p-2 text-dark d-flex text-center"> <i class="material-icons icon md-local_shipping mx-2"></i> {{ $status->status_name }}</p>
                                                </div>
                                                
                                                @elseif($status->status_name === 'Delivered')
                                                <div class="card d-flex align-items-center  ">
                                                    <p class=" p-2 text-dark d-flex text-center"> <i class="material-icons icon md-check_circle mx-2"></i> {{ $status->status_name }}</p>
                                                  </div>
                                            @else
                                            <p class="bg-secondary p-2"> {{ $status->status_name }}</p>
                                            @endif
        
                                        </td>
                                        <td>
                                          <p class="bg-secondary p-3 w-25 m-auto rounded text-light"> {{ $statusCount[$status->status_name] ?? 0 }}</p>
                                        </td>
        
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
        
                  
               
        
                </div>
            </div>
        </div>
    </div>
</section>

@endsection