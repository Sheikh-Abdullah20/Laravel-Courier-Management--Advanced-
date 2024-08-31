@extends('layouts.app')

@section('title')
Riders - View
@endsection

@section('content')
<x-alert />
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Riders - View</h2>
        </div>
        @can('create riders')
            <div>
                <a href="{{ route('rider.create') }}" class="btn btn-dark">Create Rider</a>
            </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            @can('delete riders')
                                <button type="button" onclick="submit_form() " class="btn btn-danger mx-2"><i
                                        class="icon material-icons md-delete"></i></button>
                            @endcan
                            @can('download reports')
                                <a href="{{ route('download_rider_report') }}" class="btn btn-secondary"><i
                                        class="icon material-icons md-cloud_download"></i></a>
                            @endcan
                        </div>
                    </div>
                </div>
                <form id="form" action="{{ route('rider.index') }}" method="GET">
                    @csrf
                    <div class="table-responsive">
                    <table  class="table table-bordered table-responsive table-striped text-center">
                        <thead>
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete riders'))
                                <th>Select</th>
                                @elseif(auth()->user()->hasRole('admin'))
                                <th>Select</th>
                                @endif
                                <th>Rider ID</th>
                                <th>Rider Name</th>
                                <th>Rider Bike_no</th>
                                <th>Rider Phone</th>
                                <th>Rider Address</th>
                                @if (auth()->user()->hasPermissionTo('edit riders') || auth()->user()->hasPermissionTo('show riders'))
                                    <th>Actions</th>
                                @elseif(auth()->user()->hasPermissionTo('edit riders'))
                                    <th>Actions</th>
                                @elseif(auth()->user()->hasRole('admin'))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        {{-- Opening Php for Making Counter --}}
                        @php $count = 0; @endphp
                        <tbody>
                            @foreach ($riders as $rider)
                                @php $count++; @endphp
                                <tr>
                                    @if(auth()->user()->hasPermissionTo('delete riders'))
                                    <td>
                                        <input type="checkbox" name="selected[]" id="checkbox"
                                            value="{{ $rider->id }}">
                                    </td>
                                    @elseif(auth()->user()->hasRole('admin'))
                                    <td>
                                        <input type="checkbox" name="selected[]" id="checkbox"
                                            value="{{ $rider->id }}">
                                    </td>
                                    @endif
                                    <td>{{ $count }}</td>
                                    <td>{{ $rider->name }}</td>
                                    <td>{{ $rider->bike_no }}</td>
                                    <td>{{ $rider->phone }}</td>
                                    <td>{{ $rider->address }}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            @can('show riders')
                                                <div class="col-md-2 mx-2 my-2">
                                                    <a href="{{ route('rider.show', $rider) }}" class="btn btn-sm btn-info"><i
                                                            class="icon material-icons md-visibility"></i></a>
                                                </div>
                                            @endcan
                                            @can('edit riders')
                                                <div class="col-md-2   my-2">
                                                    <a href="{{ route('rider.edit', $rider) }}"
                                                        class="btn btn-sm btn-dark"><i
                                                            class="icon material-icons md-edit"></i></a>
                                                </div>
                                            @endcan
                                </form>
                                @can('delete riders')
                                    <div class="col-md-2 mx-2  my-2">
                                        <form action="{{ route('rider.destroy', $rider) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are You Sure You Want to Delete this User?')"
                                                class="btn btn-sm btn-danger"><i class="icon material-icons md-delete"></i></button>
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
                        {{ $riders->links() }}
                    </div>
</section>
@endsection
@section('scripts')
<script>
     function submit_form() {
                    const checkbox = document.querySelectorAll('input[name="selected[]"]:checked');
                    if (checkbox.length < 1) {
                        alert('Please Select Rider First');
                    } else {
                        confirmed = confirm('Are You Sure');
                        if (confirmed) {
                            document.getElementById('form').submit();
                        }

                    }
                }
</script>
@endsection