@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Assign Class</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('manage-teachers.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



        {!! Form::model($user, ['method' => 'PATCH','route' => ['manage-teachers.update', $user->id]]) !!}

        <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>User Id:</strong>
            {!! Form::text('user_id', null, array('placeholder' => 'User Id','class' => 'form-control')) !!}
        </div>
    </div>


   {{-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Class</strong>

            
            {!! Form::select('assign_class', ['' =>'Select One']+$institutionClass,$user->assign_class, array('id' => 'section', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

        </div>
    </div> --}}


 {{--<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Section</strong>

            
            {!! Form::select('section_id', ['' =>'Select One']+$classSections,$user->section_id, array('id' => 'section', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

        </div>
    </div> --}}

   {{-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Assign class:</strong>

            {!! Form::select('assign_class', ['0' => 'Select One']+$institutionClass,$institutionClassSelected, array('id' => 'police_station', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false')) !!}
            
        </div>
    </div> --}}


     
										
										

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Phone:</strong>
            {!! Form::text('mobile_no', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Session</strong>
            
            {!! Form::select('session_id', ['' =>'Select One']+$sessions,$user->session_id, array('id' => 'section', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</div>


        {!! Form::close() !!}

@endsection