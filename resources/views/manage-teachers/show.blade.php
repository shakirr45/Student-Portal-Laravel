@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Teachers</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('manage-teachers.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User ID:</strong>

                {{ !empty($manageTeachers->user_id) ? $manageTeachers->user_id : '' }}

            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>

                {{ !empty($manageTeachers->name) ? $manageTeachers->name : '' }}

            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mobile:</strong>

                {{ !empty($manageTeachers->mobile_no) ? $manageTeachers->mobile_no : '' }}

            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>

                {{ !empty($manageTeachers->email) ? $manageTeachers->email : '' }}

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Session:</strong>
                {{ !empty($manageTeachers->sessionList->session) ? $manageTeachers->sessionList->session : '' }}

            </div>
        </div>

    {{-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Class:</strong>

                {{ !empty($manageTeachers->InstitutionClass->name) ? $manageTeachers->InstitutionClass->name : '' }}

            </div>
        </div> --}}

        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Section:</strong>
                {{ !empty($manageTeachers->classSection->name) ? $manageTeachers->classSection->name : '' }}

            </div>
        </div> --}}
        




@endsection