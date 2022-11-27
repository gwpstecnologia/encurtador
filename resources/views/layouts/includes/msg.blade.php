@if ($msg = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Tudo certo!</strong> {{ $msg }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif ($msg = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Ops!</strong> {{ $msg }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
@endif