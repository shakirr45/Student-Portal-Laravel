@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Assign Subject Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('subject-assign.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Class:</strong>

                {{ !empty($subjectAssign->class_assign_id) ? $subjectAssign->class_assign_id : '' }}

            </div>
        </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Assign Teacher:</strong>

                {{ !empty($subjectAssign->assign_teacher_id) ? $subjectAssign->assign_teacher_id : '' }}

            </div>
        </div>
        

       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subjects:</strong>
                {{ !empty($subjectAssign->subjects) ? $subjectAssign->subjects : '' }}

            </div>
        </div>  


    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Days:</strong>
                {{ !empty($subjectAssign->days) ? $subjectAssign->days : '' }}
            </div>
        </div>


@endsection