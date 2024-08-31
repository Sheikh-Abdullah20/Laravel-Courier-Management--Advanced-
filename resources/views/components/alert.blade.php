@if(session()->has('success'))
    <div class="alert alert-success" id="autoDissmiss">
        {{ session('success') }}
    </div>
@elseif(session()->has('delete'))
<div class="alert alert-danger" id="autoDissmiss">
    {{ session('delete') }}
</div>

@elseif(session()->has('error'))
<div class="alert alert-danger" id="autoDissmiss">
    {{ session('error') }}
</div>
@endif