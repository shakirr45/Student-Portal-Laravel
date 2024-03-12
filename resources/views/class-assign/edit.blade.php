@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Assign Class</h2>
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



        {!! Form::model($classAssign, ['method' => 'PATCH','route' => ['class-assign.update', $classAssign->id]]) !!}


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Class</label>

                {!! Form::select('class_id', ['' =>'Select One']+$institutionClass,$classAssign->class_id, array('id' => 'class', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 
                
                @error('class')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Section</label>

                {!! Form::select('section', ['' =>'Select One']+$classSection,$classAssign->section, array('id' => 'section', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 
                
                @error('class')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div>


           {{-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Assign Teacher</label>

                {!! Form::select('assign_teacher_id', ['' =>'Select One']+$isTeacher,$classAssign->assign_teacher_id, array('id' => 'roles', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

                @error('assign_teacher_id')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div> --}}


       {{-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Subject</label>

                {!! Form::select('subjects', ['' =>'Select One']+$subjects,$classAssign->subjects, array('id' => 'roles', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

                @error('subjects')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div> --}}


       {{-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Day</label>

                {!! Form::select('days', ['' =>'Select One']+$days,$classAssign->days, array('id' => 'roles', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

                @error('days')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div>  --}}




		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Update</button>
		    </div>
		</div>


        {!! Form::close() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection