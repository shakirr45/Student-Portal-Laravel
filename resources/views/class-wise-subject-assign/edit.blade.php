@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Assign Class</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('class-wise-subject-assign.index') }}"> Back</a>
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



        {!! Form::model($classWiseSubjectAssign, ['method' => 'PATCH','route' => ['class-wise-subject-assign.update', $classWiseSubjectAssign->id]]) !!}


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Class</label>

                {!! Form::select('class_assign_id', ['' =>'Select One']+$institutionClass,$classWiseSubjectAssign->class_assign_id, array('id' => 'class_assign_id', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 
                
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

                {!! Form::select('section_assign_id', ['' =>'Select One']+$classSection,$classWiseSubjectAssign->class_assign_id, array('id' => 'class_assign_id', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 
                
                @error('section_assign_id')
                    <span class="invalid-feedback" >
                        <b>{{ $message }}</b>
                    </span>
                @enderror
            </div>
        </div>


            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="" class="form-label">Teacher Section Wise</label>

                {!! Form::select('assign_teacher_id', ['' =>'Select One']+$assignTeacher,$classWiseSubjectAssign->assign_teacher_id, array('id' => 'assign_teacher_id', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 
                
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

                {!! Form::select('subjects', ['' =>'Select One']+$subjects,$classWiseSubjectAssign->subjects, array('id' => 'subjects', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

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

                {!! Form::select('days', ['' =>'Select One']+$days,$classWiseSubjectAssign->days, array('id' => 'days', 'class' => 'form-select', 'single' => 'single', 'required')) !!} 

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