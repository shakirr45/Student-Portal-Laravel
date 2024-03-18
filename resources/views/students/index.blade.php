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


                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="form-group">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Class</th>
                                    <th>Teacher</th>
                                    <th>Subject</th>
                                    <th>Days</th>
                                    <th>Class Schedule</th>
                                </tr>
                               @foreach($studentWiseClassShow as $class)
                                <tr>
                                    <td>{{ !empty( $class->institutionClass->name ) ? $class->institutionClass->name : " " }}</td>
                                    <td>{{ !empty( $class->userList->name ) ? $class->userList->name : " " }}</td>
                                    <td>{{ !empty( $class->subjects ) ? $class->subjects : " " }}</td>
                                    <td>{{ !empty( $class->days ) ? $class->days : " " }}</td>
                                    <td>{{ !empty( $class->class_schedule ) ? $class->class_schedule : " " }}</td>
                                </tr>
                                @endforeach 

                            </table>
                        </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">

                            <h5>Today( {{ $dayOfWeekForToday }} )  Class: </h5><br>
                            @if(count($currentDateDaysdata) > 0)
                            @foreach($currentDateDaysdata as  $data)

                            <h6>{{ !empty($data->subjects) ? $data->subjects : " " }} {{ !empty($data->class_schedule) ? $data->class_schedule : " " }}</h6>

                            @endforeach

                            @else
                            <span>No class today.</span>

                            @endif



                        </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">

                            <h5>Saturday Class: </h5>
                            @foreach($saturdaysdata as $saturday)
                              <span>Subjects: {{ $saturday->subjects }} Time: {{ $saturday->class_schedule }}</span><br>
                            @endforeach


                            <h5>Sunday Class: </h5>
                            @foreach($sundaysdata as $sunday)
                              <span>Subjects: {{ $sunday->subjects }} Time: {{ $sunday->class_schedule }}</span><br>
                            @endforeach


                            <h5>Monday Class: </h5>
                            @foreach($mondaysdata as $monday)
                              <span>Subjects: {{ $monday->subjects }} Time: {{ $monday->class_schedule }}</span><br>
                            @endforeach

                            <h5>Tuesday Class: </h5>
                            @foreach($tuesdaysdata as $tuesday)
                              <span>Subjects: {{ $tuesday->subjects }} Time: {{ $tuesday->class_schedule }}</span><br>
                            @endforeach


                            <h5>Wednesday Class: </h5>
                            @foreach($wednesdaysdata as $wednesday)
                              <span>Subjects: {{ $wednesday->subjects }} Time: {{ $wednesday->class_schedule }}</span><br>
                            @endforeach

                            <h5>Thursday Class: </h5>
                            @foreach($thursdaysdata as $thursday)
                              <span>Subjects: {{ $thursday->subjects }} Time: {{ $thursday->class_schedule }}</span><br>
                            @endforeach

                            <h5>Friday Class: </h5>
                            @foreach($fridaysdata as $friday)
                              <span>Subjects: {{ $friday->subjects }} Time: {{ $friday->class_schedule }}</span><br>
                            @endforeach


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