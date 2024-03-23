@extends('layouts.app')


@section('content')
<section class="enroll-main" style=" padding: 50px 0;">
<div class="container">


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="">
    <strong>Select All</strong>
<input type="checkbox" name="" id="select_all_ids">
</div>

{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <br/>

<div class="row">
@foreach($permission as $key => $value)
    @if($key % 4 == 0 && $key != 0)
        </div><div class="row">
    @endif
    <div class="col">
        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name checkbox_ids')) }}
        {{ $value->name }}</label>
    </div>
@endforeach
</div><br>

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


</div>
</div>


<script>
$("#select_all_ids").click(function() {
    $('.checkbox_ids').prop('checked', $(this).prop('checked'));
});
</script>
@endsection