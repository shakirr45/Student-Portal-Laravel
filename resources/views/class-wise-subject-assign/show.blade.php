@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Assign Subject Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('class-wise-subject-assign.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Class:</strong>

                {{ !empty($classWiseSubjectAssign->class_assign_id) ? $classWiseSubjectAssign->class_assign_id : '' }}

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Section:</strong>

                {{ !empty($classWiseSubjectAssign->section_assign_id) ? $classWiseSubjectAssign->section_assign_id : '' }}

            </div>
        </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Assign Teacher:</strong>

                {{ !empty($classWiseSubjectAssign->assign_teacher_id) ? $classWiseSubjectAssign->assign_teacher_id : '' }}

            </div>
        </div>
        

       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subjects:</strong>
                {{ !empty($classWiseSubjectAssign->subjects) ? $classWiseSubjectAssign->subjects : '' }}

            </div>
        </div>  


    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Days:</strong>
                {{ !empty($classWiseSubjectAssign->days) ? $classWiseSubjectAssign->days : '' }}
            </div>
        </div>


@endsection