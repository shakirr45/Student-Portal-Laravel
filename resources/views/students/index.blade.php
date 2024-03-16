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
                                    <th>Days</th>
                                </tr>
                               @foreach($studentWiseClassShow as $class)
                                <tr>
                                    <td>{{ !empty( $class->class_id ) ? $class->class_id : " " }}</td>
                                    <td>{{ !empty( $class->user_id ) ? $class->user_id : " " }}</td>
                                    <td>{{ !empty( $class->subjects ) ? $class->subjects : " " }}</td>
                                    <td>
                                          {{ !empty( $class->days ) ? $class->days : " " }}
                                    </td>
                                </tr>
                                @endforeach 

                            </table>
                        </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">

                            <h4>Today( {{ $dayOfWeekForToday }} )  Class: </h4><br>
                            @foreach($currentDateDaysdata as  $data)

                            <h6>{{ $data->subjects }}</h6>

                            @endforeach



                        </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">

                            <h6>Saturday Class: </h6>
                            @foreach($saturdaysdata as $saturday)
                              <span>Subjects: {{ $saturday->subjects }}</span><br>
                            @endforeach


                            <h6>Sunday Class: </h6>
                            @foreach($sundaysdata as $sunday)
                              <span>Subjects: {{ $sunday->subjects }}</span><br>
                            @endforeach


                            <h6>Monday Class: </h6>
                            @foreach($mondaysdata as $monday)
                              <span>Subjects: {{ $monday->subjects }}</span><br>
                            @endforeach

                            <h6>Tuesday Class: </h6>
                            @foreach($tuesdaysdata as $tuesday)
                              <span>Subjects: {{ $tuesday->subjects }}</span><br>
                            @endforeach


                            <h6>Wednesday Class: </h6>
                            @foreach($wednesdaysdata as $wednesday)
                              <span>Subjects: {{ $wednesday->subjects }}</span><br>
                            @endforeach

                            <h6>Thursday Class: </h6>
                            @foreach($thursdaysdata as $thursday)
                              <span>Subjects: {{ $thursday->subjects }}</span><br>
                            @endforeach

                            <h6>Friday Class: </h6>
                            @foreach($fridaysdata as $friday)
                              <span>Subjects: {{ $friday->subjects }}</span><br>
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