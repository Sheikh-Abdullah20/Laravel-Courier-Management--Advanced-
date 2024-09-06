@extends('layouts.app')


@section('title')
Status - View
@endsection

@section('content')
<x-alert />
<section class="content-main">
    <div class="content-header">

        <div>
            <h2 class="content-title">Status - View</h2>
        </div>
        @can('create status')
        <div>
            <a href="{{ route('status.create') }}" class="btn btn-light font-sm"><i class="icon material-icons md-create mx-1" ></i>Create status</a>
        </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form" action="{{ route('status.index') }}" method="GET">
                        @can('delete status')
                        <div class="row">
                            <div class="col-md-12 d-flex  justify-content-end">
                                <a id="submit_button" class="btn btn-danger font-sm mb-3 mx-1"><i class="icon material-icons md-delete"></i>Delete Status</a>
                            </div>
                        </div>
                        @endcan
                    <div class="table-responsive">
                    <table id="statusTable" class="table  table-striped text-center">
                        <thead>
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete status'))
                                <th><input type="checkbox" class="form-check-input" id="selectAll" onclick="AllSelected(this)"></th>
                                @elseif(auth()->user()->hasRole('admin'))
                                <th><input type="checkbox" class="form-check-input" id="selectAll" onclick="AllSelected(this)"></th>
                                @endif
                                <th>Status ID</th>
                                <th>Status Name</th>
                                @if(auth()->user()->hasPermissionTo('edit status') || auth()->user()->hasPermissionTo('delete status') )
                                <th>Actions</th>
                                @elseif(auth()->user()->hasrole('admin'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        {{-- Opening Php for Making Counter --}}
                        @php $count = 0; @endphp
                        <tbody>
                            @foreach($statuss as $status)
                                @php $count++; @endphp
                            <tr>
                                @if(auth()->user()->hasPermissionTo('delete status'))
                                <td>
                                    <input type="checkbox" name="selected[]" value="{{ $status->id }}" class="form-check-input">
                                </form>
                                </td>
                                @elseif(auth()->user()->hasRole('admin'))
                                <td>
                                    <input type="checkbox" name="selected[]" value="{{ $status->id }}" class="form-check-input">
                                </form>
                                </td>
                                @endif
                                <td>{{$count}}</td>
                                <td>{{ $status->status_name }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        @can('edit status')
                                        <div class="col-md-1 mx-1 my-2">
                                            <a href="{{ route('status.edit',$status) }}" class="btn btn-sm btn-dark"><i class="icon material-icons md-edit"></i></a>
                                        </div>
                                        @endcan
                                        @can('delete status')
                                        <div class="col-md-1 mx-1 my-2">
                                            <form action="{{ route('status.destroy',$status) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete This Status?')"><i class="icon material-icons md-delete"></i></button>
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
            {{ $statuss->links() }}
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
         alert('Please Select Atleast One Status');
         return false;
     }else{
        let confirmed = confirm('Are You Sure You want to Delete Status?') 
        if(confirmed){
            document.getElementById('form').submit();
        }
     }

    });
       
    
     
     function AllSelected(){
        let checkboxes = document.querySelectorAll('input[name="selected[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = document.getElementById('selectAll').checked;
        });
     }
</script>
@endsection