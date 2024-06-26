@extends('layouts.app')

@section('content')
<section class="enroll-main" style=" padding: 50px 0;">
<div class="container">


    <div class="row" >
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create Student </h2>
            </div>
            <div class="pull-right" style="padding: 5px; float:right;">
                <a class="btn btn-primary" href="{{ route('manage-students.index') }}"> Back</a>
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


    <form action="{{ route('manage-students.store') }}" method="POST">
    	@csrf


    <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 5px;">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control',  'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 5px;">
        <div class="form-group">
            <strong>User Id:</strong>
            {!! Form::text('user_id', null, array('placeholder' => 'User Id','class' => 'form-control' ,'required' => 'required')) !!}
        </div>
    </div>

{{--    <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 5px;">
        <div class="form-group">
            <strong>Assign Class:</strong>
            {!! Form::select('assign_class_id', ['' => 'Select One']+$institutionClass,'', array('id' => 'class', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false',  'required' => 'required')) !!} 
        </div>
    </div> --}}
{{--    <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 5px;">
        <div class="form-group">
            <strong>Assign Class:</strong>
            {!! Form::select('assign_class_id[]', ['' => 'Select One']+$institutionClass,'', array('id' => 'class', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false',  'required' => 'required','multiple')) !!} 
        </div>
    </div>--}}

    <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 5px;">
        <div class="form-group">
            <strong>Phone:</strong>
            {!! Form::text('mobile_no', null, array('placeholder' => 'Phone','class' => 'form-control' ,'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 5px;">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control' ,'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 5px;">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control' ,'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 5px;">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control' ,'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding: 5px;">
    <div class="form-group">
        <label for="" class="form-label">Institution Class</label>

        {!! Form::select('assign_class_id', ['' => 'Select One']+$institutionClass,'', array('id' => 'class_assign_id', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false', 'required' => 'required')) !!} 

        @error('assign_class_id')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    </div>

            
            

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding: 5px;">
                <div class="form-group">
                    <label for="" class="form-label">Section</label>
                    
                    {!! Form::select('section_id', ['' => 'Select One']+$classSection,'', array('id' => 'section_id', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false', 'required' => 'required')) !!} 

                    @error('section_id')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding: 5px;">
                <div class="form-group">
                    <label for="" class="form-label">Sessions</label>
                    
                    {!! Form::select('session_id', ['' => 'Select One']+$sessions,'', array('id' => 'section_id', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false', 'required' => 'required')) !!} 

                    @error('section_id')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            


		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


    
</div>
</section>

@endsection