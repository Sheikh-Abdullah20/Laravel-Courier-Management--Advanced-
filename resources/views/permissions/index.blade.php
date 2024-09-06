@extends('layouts.app')

@section('title')
Permission - View
@endsection

@section('content')
<x-alert />
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Permissions - View</h2>
        </div>

        @can('create permissions')
        <div>
            <a href="{{ route('permission.create') }}" class="btn btn-light font-sm"><i class="icon material-icons md-create mx-1"></i>Create Permission</a>
        </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form" action="{{ route('permission.index') }}" method="GET">
                        @can('delete permissions')
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex  justify-content-end">
                                <a id="submit_button" class="btn btn-danger font-sm mx-1"><i class="icon material-icons md-delete"></i>Delete Permissions</a>
                            </div>
                        </div>
                        @endcan
                    <div class="table-responsive">
                    <table id="permissionTable" class="table  table-striped text-center">
                        <thead>
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete permissions'))
                                <th><input type="checkbox" class="form-check-input" id="selectAll" onclick="AllSelected(this)"></th>
                                @elseif(auth()->user()->hasRole('admin'))
                                <th><input type="checkbox" class="form-check-input" id="selectAll" onclick="AllSelected(this)"></th>
                                @endif
                                <th>Permission Name</th>
                                @if(auth()->user()->hasPermissionTo('edit permissions') || auth()->user()->hasPermissionTo('delete permissions'))
                                <th>Actions</th>
                                @elseif(auth()->user()->hasRole('admin'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        {{-- Opening Php for Making Counter --}}
                      
                        <tbody>
                            @foreach($permissions as $permission)
                                
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete permissions'))
                                <td>
                                        <input type="checkbox" name="selected[]" value="{{ $permission->id }}" class="form-check-input">
                                    </form>
                                </td>
                                @elseif(auth()->user()->hasRole('admin'))
                                <td>
                                    <input type="checkbox" name="selected[]" value="{{ $permission->id }}" class="form-check-input">
                                </form>
                                 </td>
                                @endif
                               
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        @can('edit permissions')
                                        <div class="col-md-1 mx-2 my-2">
                                            <a href="{{ route('permission.edit',$permission) }}" class="btn btn-sm btn-dark"><i class="icon material-icons md-edit"></i></a>
                                        </div>
                                        @endcan
                                        @can('delete permissions')
                                        <div class="col-md-1 mx-2 my-2">
                                            <form action="{{ route('permission.destroy',$permission) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete This Permission?')"><i class="icon material-icons md-delete"></i></button>
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
            {{ $permissions->links() }}
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
         alert('Please Select Atleast One Permission');
         return false;
     }else{
        let confirmed = confirm('Are You sure you want to Delete Permissions?');
        if(confirmed){
            document.getElementById('form').submit();
        }
     }

    });
       
    
function AllSelected(){
    const checkbox = document.querySelectorAll('input[name="selected[]"]');
    checkbox.forEach(checkbox =>{
        checkbox.checked = document.getElementById('selectAll').checked;
    });
 
}   
</script>
@endsection