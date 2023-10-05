

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible   text-center">
    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible text-center">
    <h5><i class="icon fas fa-ban"></i> Error!</h5>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible text-center">
    <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian!</h5>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible text-center">
    <h5><i class="icon fas fa-info"></i> Info!</h5>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible text-center">
    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
    <strong>{!! implode('', $errors->all('<div>:message</div>')) !!}</strong>
</div>
@endif
