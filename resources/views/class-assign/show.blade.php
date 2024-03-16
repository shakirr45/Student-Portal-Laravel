@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Assign Class</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('class-assign.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Class:</strong>

                {{ !empty($classAssign->class_id) ? $classAssign->class_id : '' }}

            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Section:</strong>
                {{ !empty($classAssign->section_id) ? $classAssign->section_id : '' }}

            </div>
        </div>



       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subjects:</strong>
                {{ !empty($classAssign->subjects) ? $classAssign->subjects : '' }}

            </div>
        </div>

       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Assign Teacher:</strong>
                {{ !empty($classAssign->user_id) ? $classAssign->user_id : '' }}

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Days:</strong>
                {{ !empty($classAssign->days) ? $classAssign->days : '' }}
            </div>
        </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Class Schedule:</strong>
                {{ !empty($classAssign->class_schedule) ? $classAssign->class_schedule : '' }}
            </div>
        </div>
@endsection