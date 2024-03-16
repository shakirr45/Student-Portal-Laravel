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

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <h3>Welcome {{ !empty(Auth::user()->name) ? Auth::user()->name : " " }}</h3><br>
                        </div>
                        </div>

  

                    <div class="container">
                        <div class="row">


                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="form-group">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Class</th>
                                    <th>section</th>
                                    <th>Subjects</th>
                                    <th>Days</th>
                                    <th>Class Schedule</th>
                                </tr>
                               @foreach($teachertWiseClassShow as $class)
                                <tr>
                                    <td>{{ !empty( $class->class_id ) ? $class->class_id : " " }}</td>
                                    <td>{{ !empty( $class->section_id ) ? $class->section_id : " " }}</td>
                                    <td>{{ !empty( $class->subjects ) ? $class->subjects : " " }}</td>
                                    <td>{{ !empty( $class->class_schedule ) ? $class->class_schedule : " " }}</td>
                                    <td>
                                          {{ !empty( $class->days ) ? $class->days : " " }}
                                    </td>
                                </tr>
                                @endforeach 

                            </table>
                        </div>
                        </div>


                        <div class="col-xs-8 col-sm-8 col-md-4 col-lg-4">
                        <div class="form-group">

                            <h4>Today( {{ $dayOfWeekForToday }} )  Class: </h4><br>
                            @foreach($currentDateDaysClass as  $class)

                            <span>Subject: {{ $class->subjects }}  ----- Class: {{ $class->class_id }} ---- Section: {{ $class->section_id }} --- Time: {{ $class->class_schedule }}</span><br>
                            <h6></h6>

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