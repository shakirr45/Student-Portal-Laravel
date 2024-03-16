@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Students</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('manage-students.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User ID:</strong>

                {{ !empty($manageStudents->user_id) ? $manageStudents->user_id : '' }}

            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>

                {{ !empty($manageStudents->name) ? $manageStudents->name : '' }}

            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mobile:</strong>

                {{ !empty($manageStudents->mobile) ? $manageStudents->mobile : '' }}

            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>

                {{ !empty($manageStudents->email) ? $manageStudents->email : '' }}

            </div>
        </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Class:</strong>

                {{ !empty($manageStudents->assign_class) ? $manageStudents->assign_class : '' }}

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Section:</strong>
                {{ !empty($manageStudents->section_id) ? $manageStudents->section_id : '' }}

            </div>
        </div>
        




@endsection