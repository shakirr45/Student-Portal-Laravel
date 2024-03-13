@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  

                    <div class="container">
                        <div class="row">




                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <h3>Welcome {{ !empty(Auth::user()->name) ? Auth::user()->name : " " }}</h3><br>
                        </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <h3>Section {{ !empty(Auth::user()->section_id) ? Auth::user()->section_id : " " }}</h3><br>
                        </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Class</th>
                                    <th>Teacher</th>
                                    <th>Subject</th>
                                </tr>
                                @foreach($studentWiseClassShow as $class)
                                <tr>
                                    <td>{{ !empty( $class->class_assign_id ) ? $class->class_assign_id : " " }}</td>
                                    <td>{{ !empty( $class->assign_teacher_id ) ? $class->assign_teacher_id : " " }}</td>
                                    <td>{{ !empty( $class->subjects ) ? $class->subjects : " " }}</td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                        </div>



                        </div>
                    </div>
                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection