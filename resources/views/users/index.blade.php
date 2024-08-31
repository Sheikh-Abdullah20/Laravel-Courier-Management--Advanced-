@extends('layouts.app')

@section('title')
    Users - View
@endsection


@section('content')
    <x-alert />
    <section class="content-main">
        <div class="content-header">

            <div>
                <h2 class="content-title">Users - View</h2>
            </div>
            @can('create users')
                <div>
                    <a href="{{ route('user.create') }}" class="btn btn-dark">Create User</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                                <div class="col-md-6 d-flex justify-content-start">
                                    <form class="w-50 d-flex" action="{{ route('user.index') }}" method="GET">
                                        <input type="search" class="form-control" name="search" placeholder="Search Here..">
                                        <button type="submit" class="btn btn-dark mx-2">Search</button>
                                    </form>

                                </div>

                            <div class="col-md-6  d-flex justify-content-end">
                                @can('delete users')
                                    <button type="button" onclick="submit_form() " class="btn btn-danger mx-2"><i
                                            class="icon material-icons md-delete"></i></button>
                                @endcan
                                @can('download reports')
                                    <a href="{{ route('download_user_report') }}" class="btn btn-secondary"><i
                                            class="icon material-icons md-cloud_download"></i></a>
                                @endcan
                            </div>
                        </div>
                    </div>
                   
                    <form id="form" action="{{ route('user.index') }}" method="GET">
                        @csrf
                        <div class="table-responsive">
                        <table id="userTable" class="table table-bordered table-responsive table-striped text-center">
                            <thead>
                                <tr>
                                    @if(auth()->user()->hasPermissionTo('delete users'))
                                    <th>Select</th>
                                    
                                    @elseif(auth()->user()->hasRole('admin'))
                                    <th>Select</th>
                                    @endif
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>User Phone</th>
                                    <th>User Role</th>
                                    @if (auth()->user()->hasPermissionTo('edit users') || auth()->user()->hasPermissionTo('show users'))
                                        <th>Actions</th>
                                    @elseif(auth()->user()->hasPermissionTo('edit users') || auth()->user()->hasRole('admin'))
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            {{-- Opening Php for Making Counter --}}
                            @php $count = 0; @endphp
                            <tbody>
                                @foreach ($users as $user)
                                    @php $count++; @endphp
                                    <tr>
                                        @if(auth()->user()->hasPermissionTo('delete users'))
                                        <td>
                                            <input type="checkbox" name="selected[]" id="checkbox"
                                                value="{{ $user->id }}">
                                        </td>
                                        @elseif(auth()->user()->hasRole('admin'))
                                        <td>
                                            <input type="checkbox" name="selected[]" id="checkbox"
                                                value="{{ $user->id }}">
                                        </td>
                                        @endif
                                        <td>{{ $count }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->roles->pluck('name')->implode('') }}</td>
                                        <td>
                                            <div class="row justify-content-center">
                                                @can('show users')
                                                    <div class="col-md-2 mx-2 my-2">
                                                        <a href="{{ route('user.show', $user) }}" class="btn btn-sm btn-info"><i
                                                                class="icon material-icons md-visibility"></i></a>
                                                    </div>
                                                @endcan
                                                @can('edit users')
                                                    <div class="col-md-2   my-2">
                                                        <a href="{{ route('user.edit', $user) }}"
                                                            class="btn btn-sm btn-dark"><i
                                                                class="icon material-icons md-edit"></i></a>
                                                    </div>
                                                @endcan
                                    </form>
                                    @can('delete users')
                                        <div class="col-md-2 mx-2  my-2">
                                            <form action="{{ route('user.destroy', $user) }}" method="POST">
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
                            {{ $users->links() }}
                        </div>
    </section>
@endsection

@section('scripts')
    <script>
                function submit_form() {
                    const checkbox = document.querySelectorAll('input[name="selected[]"]:checked');
                    if (checkbox.length < 1) {
                        alert('Please Select User First');
                    } else {
                        confirmed = confirm('Are You Sure');
                        if (confirmed) {
                            document.getElementById('form').submit();
                        }

                    }
                }
    </script>
@endsection
