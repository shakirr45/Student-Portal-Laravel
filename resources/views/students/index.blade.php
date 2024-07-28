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
                         <h3>Section: ( {{ !empty( $getSection->name ) ? $getSection->name : " " }} )</h3><br>
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
                                    {{-- <th>Action</th>--}}
                                </tr>
                               @foreach($studentWiseClassShow as $class)
                                <tr>
                                  <td>{{ !empty( $class->class ) ? $class->class : " " }}</td>
                                    <td>{{ !empty( $class->userList->name ) ? $class->userList->name : " " }}</td>
                                   <td>{{ !empty( $class->subjects->name ) ? $class->subjects->name : " " }}</td>
                                      <td>{{ !empty( $class->days ) ? $class->days : " " }}</td>
                                    <td>{{ !empty( $class->class_schedule ) ? $class->class_schedule : " " }}</td>
                                    {{--<td>
                                    <a class="btn btn-primary" href="#"></a>
                                    </td>--}}
                                       
                               
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

                            <h6>{{ !empty($data->subjects->name) ? $data->subjects->name : " " }} {{ !empty($data->class_schedule) ? $data->class_schedule : " " }} Teacher: {{ !empty( $data->userList->name ) ? $data->userList->name : " " }}</h6>

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
                              <span>Subjects: {{ $saturday->subjects->name }} Time: {{ $saturday->class_schedule }} Teacher: {{ $saturday->class_schedule }}</span><br>
                            @endforeach


                            <h5>Sunday Class: </h5>
                            @foreach($sundaysdata as $sunday)
                              <span>Subjects: {{ $sunday->subjects->name }} Time: {{ $sunday->class_schedule }} Teacher: {{ $sunday->userList->name }}</span><br>
                            @endforeach


                            <h5>Monday Class: </h5>
                            @foreach($mondaysdata as $monday)
                              <span>Subjects: {{ $monday->subjects->name }} Time: {{ $monday->class_schedule }} Teacher: {{ $monday->userList->name }}</span><br>
                            @endforeach

                            <h5>Tuesday Class: </h5>
                            @foreach($tuesdaysdata as $tuesday)
                              <span>Subjects: {{ $tuesday->subjects->name }} Time: {{ $tuesday->class_schedule }} Teacher: {{ $tuesday->userList->name }} </span><br>
                            @endforeach


                            <h5>Wednesday Class: </h5>
                            @foreach($wednesdaysdata as $wednesday)
                              <span>Subjects: {{ $wednesday->subjects->name }} Time: {{ $wednesday->class_schedule }} Teacher: {{ $wednesday->userList->name }}</span><br>
                            @endforeach

                            <h5>Thursday Class: </h5>
                            @foreach($thursdaysdata as $thursday)
                              <span>Subjects: {{ $thursday->subjects->name }} Time: {{ $thursday->class_schedule }} Teacher:{{ $thursday->userList->name }} </span><br>
                            @endforeach

                            <h5>Friday Class: </h5>
                            @foreach($fridaysdata as $friday)
                              <span>Subjects: {{ $friday->subjects->name }} Time: {{ $friday->class_schedule }} Teacher:{{ $friday->userList->name }} </span><br>
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