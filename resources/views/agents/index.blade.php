@extends('layouts.app')

@section('title')
Agents - View
@endsection

@section('content')

<x-alert />
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Agents - View</h2>
        </div>
        @can('create agents')
        <div class="mb-4">
            <a href="{{ route('agent.create') }}" class="btn btn-dark">Create Agent</a>
        </div>
        @endcan
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row my-3 mx-4">
                        <div class="col-md-12 d-flex justify-content-end">
                            @can('delete agents')
                            <button class="btn btn-danger mx-2" type="button" onclick="select()"><i class="icon material-icons md-delete"></i></button>
                            @endcan
                            @can('download reports')
                            <a href="{{ route('download_agent_report') }}" class="btn btn-secondary"><i
                                class="icon material-icons md-cloud_download"></i></a>
                                @endcan
                        </div>
                    </div>
                    <form id="form" action="{{ route('agent.index') }}" method="GET">
                        @csrf
                        <div class="table-responsive">
                    <table id="agentTable" class="table table-bordered  table-striped text-center">
                        <thead>
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete agents'))
                                <th>Select</th>
                                @elseif(auth()->user()->hasRole('admin'))
                                <th>Select</th>
                                @endif
                                <th>Agent ID</th>
                                <th>Agent Name</th>
                                <th>Branch Name</th>
                                <th>Email</th>
                                <th>Agent Phone</th>
                                <th>Branch Address</th>
                                <th>Branch Status</th>
                                @if(auth()->user()->hasPermissionTo('edit agents') || auth()->user()->hasPermissionTo('show agents'))
                                <th>Actions</th>
                                @elseif(auth()->user()->hasPermissionTo('delete agents'))
                                <th>Actions</th>
                                @elseif(auth()->user()->hasRole('admin'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        {{-- Opening Php for Making Counter --}}
                        @php $count = 0; @endphp
                        <tbody>
                            @foreach($agents as $agent)
                                @php $count++; @endphp
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete agents'))
                                <td>
                                 <input type="checkbox" name="selected[]" id="select" value="{{ $agent->id }}">
                                </form>
                                </td>
                                @elseif(auth()->user()->hasRole('admin'))
                                <td>
                                 <input type="checkbox" name="selected[]" id="select" value="{{ $agent->id }}">
                                </form>
                                </td>
                                @endif
                                <td>{{$count}}</td>
                                <td>{{$agent->owner_name}}</td>
                                <td>{{ $agent->branch_name}}</td>
                                <td>{{ $agent->email }}</td>
                                <td>{{ $agent->owner_phone }}</td>
                                <td class="w-25">{{ $agent->branch_address }}</td>
                                <td>
                                    @if($agent->branch_status === 'Active')
                                    <p class="bg-success rounded text-light p-2">{{ $agent->branch_status }}</p>
                                    @elseif($agent->branch_status === 'In-Active')
                                    <p class="bg-danger rounded text-light p-2">{{ $agent->branch_status }}</p>
                                    @endif
                                </td>
                                <td>
                                    <div class="row justify-content-center">
                                        @can('show agents')
                                        <div class="col-md-2 mx-2 my-2">
                                            <a href="{{ route('agent.show',$agent) }}" class="btn btn-sm btn-info"><i class="icon material-icons md-visibility"></i></a>
                                        </div>
                                        @endcan

                                        @can('edit agents')
                                        <div class="col-md-2 my-2">
                                            <a href="{{ route('agent.edit',$agent) }}" class="btn btn-sm btn-dark"><i class="icon material-icons md-edit"></i></a>
                                        </div>
                                        @endcan
                                        @can('delete agents')
                                        <div class="col-md-2 mx-2  my-2">
                                            <form action="{{ route('agent.destroy',$agent) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are You Sure You Want to Delete This Agent? ')" class="btn btn-sm btn-danger"><i class="icon material-icons md-delete"></i></button>
                                            </form>
                                        </div>   
                                        @endcan     
                                    </div>
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

    <div class="row">
        {{ $agents->links() }}
    </div>





</section>

@endsection

@section('scripts')
    <script>
        function select(){
            const checkbox = document.querySelectorAll('input[name="selected[]"]:checked');
            if(checkbox.length < 1){
                alert('Please select Agent First');
            }else{
                confirmed = confirm('Are You sure you want to Delete this Agent?');
                if(confirmed){
                    document.getElementById('form').submit();
                }
            }
     
        }
    </script>
@endsection