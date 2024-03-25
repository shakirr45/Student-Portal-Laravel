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

                {{ !empty($classAssign->institutionClass->name) ? $classAssign->institutionClass->name : '' }}

            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Section:</strong>
                {{ !empty($classAssign->classSection->name) ? $classAssign->classSection->name : '' }}

            </div>
        </div>



       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subjects:</strong>

                {{ !empty($classAssign->subjects->name) ? $classAssign->subjects->name : " "}}

            </div>
        </div>

       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Assign Teacher:</strong>
                {{ !empty($classAssign->userList->name) ? $classAssign->userList->name : '' }}

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
