@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Assign Class</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('subject-assign.index') }}"> Back</a>
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



        {!! Form::model($subjectAssign, ['method' => 'PATCH','route' => ['subject-assign.update', $subjectAssign->id]]) !!}


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Class Section Wise</label>

                {!! Form::select('class_assign_id', ['' =>'Select One']+$reArrangeClass,$subjectAssign->class_assign_id, array('id' => 'class_assign_id', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 
                
                @error('class')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div>


            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Teacher Section Wise</label>

                {!! Form::select('assign_teacher_id', ['' =>'Select One']+$assignTeacher,$subjectAssign->assign_teacher_id, array('id' => 'assign_teacher_id', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 
                
                @error('assign_teacher_id')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Subject</label>

                {!! Form::select('subjects', ['' =>'Select One']+$subjects,$subjectAssign->subjects, array('id' => 'subjects', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

                @error('subjects')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div> 


       <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Day</label>

                {!! Form::select('days', ['' =>'Select One']+$days,$subjectAssign->days, array('id' => 'days', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

                @error('days')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div>  


		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Update</button>
		    </div>
		</div>


        {!! Form::close() !!}

@endsection