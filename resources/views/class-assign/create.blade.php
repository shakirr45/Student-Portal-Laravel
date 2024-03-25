@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Assign New Class</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('class-assign.index') }}"> Back</a>
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


    <form action="{{ route('class-assign.store') }}" method="POST">
    	@csrf


         <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="" class="form-label">Institution Class</label>
                    
                    {!! Form::select('class_id', ['' => 'Select One']+$institutionClass,'', array('id' => 'class_id', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false',  'required' => 'required')) !!} 
                    
                    @error('roles')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="" class="form-label">Section</label>
                    
                    {!! Form::select('section_id', ['' => 'Select One']+$classSection,'', array('id' => 'section_id', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false', 'required' => 'required')) !!} 
                    
                    @error('roles')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="" class="form-label">Assign Teacher</label>
                    
                    {!! Form::select('teacher_id', ['' => 'Select One']+$isTeacher,'', array('id' => 'user_id', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false',  'required' => 'required')) !!} 
                    
                    @error('roles')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div> 


             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="" class="form-label">Subjects</label>
                    
                    {!! Form::select('subject_id', ['' => 'Select One']+$subjects,'', array('id' => 'subjects', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false', 'required' => 'required')) !!} 
                    
                    @error('roles')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>  


             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="" class="form-label">Class Schedule</label>
                    
                    {!! Form::text('time_start', null, array('placeholder' => 'time start. Ex( 01.00 )','class' => 'form-control')) !!}
                    
                    {!! Form::select('pm_or_am_first', ['PM' => 'PM', 'AM' => 'AM'], null, ['class' => 'form-control']) !!}
                    
                    
                    {!! Form::text('time_end', null, array('placeholder' => 'time end. Ex( 01.00 )','class' => 'form-control')) !!}

                    {!! Form::select('pm_or_am_second', ['PM' => 'PM', 'AM' => 'AM'], null, ['class' => 'form-control']) !!}

                    @error('roles')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>  


            


             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="" class="form-label">Days</label>
                    
                    {!! Form::select('days', ['' => 'Select One']+$days,'', array('id' => 'days', 'class' => 'form-select form-small select select2-hidden-accessible ', 'tabindex' => '-1', 'aria-hidden' => 'false', 'required' => 'required')) !!} 
                    
                    @error('roles')
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


@endsection