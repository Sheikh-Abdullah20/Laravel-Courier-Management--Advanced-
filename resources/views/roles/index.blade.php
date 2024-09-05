@extends('layouts.app')

@section('title')
Roles - View
@endsection

@section('content')
<x-alert />
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Roles - View</h2>
        </div>
        @can('create roles')
        <div>
            <a href="{{ route('role.create') }}" class="btn btn-light font-sm"><i class="icon material-icons md-create mx-1"></i>Create Role</a>
        </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form" action="{{ route('role.index') }}" method="GET">
                    @can('delete roles')
                    <div class="row">
                        <div class="col-md-12 d-flex  justify-content-end">
                            <a id="submit_button"  class="btn btn-danger mx-1 mb-3 font-sm"><i class="icon material-icons md-delete"></i>Delete Roles</a>
                        </div>
                    </div>
                    @endcan
                    <div class="table-responsive">
                    <table id="roleTable" class="table  table-striped text-center">
                        <thead>
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete roles'))
                                <th>Select</th>
                                @elseif(auth()->user()->hasRole('admin'))
                                <th>Select</th>
                                @endif
                                <th>Role ID</th>
                                <th>Role Name</th>
                                <th>Role Permissions</th>
                                @if(auth()->user()->hasPermissionTo('edit roles') || auth()->user()->hasPermissionTo('delete roles'))
                                <th>Actions</th>
                                @elseif(auth()->user()->hasRole('admin'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        {{-- Opening Php for Making Counter --}}
                        @php $count = 0; @endphp
                        <tbody>
                            @foreach($roles as $role)
                                @php $count++; @endphp
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete roles'))
                                <td>
                                    <input type="checkbox" value="{{ $role->id }}" name="selected[]" class="form-check-input">
                                </form>
                                </td>
                                @elseif(auth()->user()->hasRole('admin'))
                                <td>
                                    <input type="checkbox" value="{{ $role->id }}" name="selected[]" class="form-check-input">
                                </form>
                                </td>
                                @endif
                                <td>{{$count}}</td>
                                <td>{{ $role->name }}</td>
                                <td class="w-25">{{ $role->permissions->pluck('name')->implode(' , ') }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        @can('edit roles')
                                        <div class="col-md-1 mx-2 my-2">
                                            <a href="{{ route('role.edit',$role) }}" class="btn btn-sm btn-dark"><i class="icon material-icons md-edit"></i></a>
                                        </div>
                                        @endcan
                                        @can('delete roles')
                                        <div class="col-md-1 mx-2 my-2">
                                            <form action="{{ route('role.destroy',$role) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete This Role??')"><i class="icon material-icons md-delete"></i></button>
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
    <div class="pagination-area mt-30 mb-50">
        <nav aria-label="Page navigation example">
            {{ $roles->links() }}
        </nav>
    </div>





</section>
@endsection

@section('scripts')
<script>
    const submit = document.getElementById('submit_button');
    submit.addEventListener('click', function(){
        console.log('submit');
     const checkbox =  document.querySelectorAll('input[name="selected[]"]:checked');
     if(checkbox.length < 1){
         alert('Please Select Atleast One Role');
         return false;
     }else{
         document.getElementById('form').submit();
     }

    });
       
    
     
</script>
@endsection