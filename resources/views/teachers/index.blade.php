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
                                    {{--<th>Days</th>
                                    <th>Class Schedule</th>--}}
                                    <th>Action</th>
                                </tr>
                               @foreach($teachertWiseClassShow as $class)
                                <tr>
                                    <td>{{ !empty( $class->class ) ? $class->class : " " }}</td>
                                    <td>{{ !empty( $class->classSection->name ) ? $class->classSection->name : " " }}</td>
                                    <td>{{ !empty( $class->subjects->name ) ? $class->subjects->name : " " }}</td>
                                  
                                    {{--<td> {{ !empty( $class->days ) ? $class->days : " " }} </td>
                                    <td>{{ !empty( $class->class_schedule ) ? $class->class_schedule : " " }}</td>--}}
                                    <td>

                                    <a class="btn btn-primary" href="{{ url('student-data',$class->class,$class->subject_id) }}">Student Data</a>
                                    </td>
                                </tr>
                                @endforeach 

                            </table>
                        </div>
                        </div>


                        <div class="col-xs-8 col-sm-8 col-md-4 col-lg-4">
                        <div class="form-group">

                            <h4>Today( {{ $dayOfWeekForToday }} )  Class: </h4><br>
                            @if(count($currentDateDaysClass) > 0)
                            @foreach($currentDateDaysClass as  $class)
                            
                            <span><b>Subject: {{ !empty($class->subjects->name) ? $class->subjects->name : " " }} ----- Class: {{ !empty($class->class) ? $class->class : " " }} ---- Section: {{ !empty($class->classSection->name) ? $class->classSection->name : " " }} --- Time: {{ !empty($class->class_schedule) ? $class->class_schedule : " " }}</b></span><br>

                            <h6></h6>
                            <hr>

                            @endforeach

                            @else
                            <span>No class today.</span>

                            @endif


                        </div>
                        </div>








                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">

                            <h5>Saturday Class: </h5>
                            @foreach($saturdaysdataForTeachers as $saturday)
                                <span>class: {{ !empty($saturday->class) ? $saturday->class : "" }} --- 
                                Section: {{ !empty($saturday->ClassSection->name) ? $saturday->ClassSection->name : "" }} --- 
                                Subjects: {{ !empty($saturday->subjects->name) ? $saturday->subjects->name : "" }} Time: {{ !empty($saturday->class_schedule) ? $saturday->class_schedule : "" }}</span><br>
                            @endforeach

                            <h5>Sunday Class: </h5>
                            @foreach($sundaysdataForTeachers as $sunday)
                                <span>class: {{ !empty($sunday->class) ? $sunday->class : "" }} --- 
                                Section: {{ !empty($sunday->ClassSection->name) ? $sunday->ClassSection->name : "" }} --- 
                                Subjects: {{ !empty($sunday->subjects->name) ? $sunday->subjects->name : "" }} Time: {{ !empty($sunday->class_schedule) ? $sunday->class_schedule : "" }}</span><br>
                            @endforeach

                            <h5>Monday Class: </h5>
                            @foreach($mondaysdataForTeachers as $monday)
                                <span>class: {{ !empty($monday->class) ? $monday->class : "" }} --- 
                                Section: {{ !empty($monday->ClassSection->name) ? $monday->ClassSection->name : "" }} --- 
                                Subjects: {{ !empty($monday->subjects->name) ? $monday->subjects->name : "" }} Time: {{ !empty($monday->class_schedule) ? $monday->class_schedule : "" }}</span><br>
                            @endforeach

                            <h5>Tuesday Class: </h5>
                            @foreach($tuesdaysdataForTeachers as $tuesday)
                                <span>class: {{ !empty($tuesday->class) ? $tuesday->class : "" }} --- 
                                Section: {{ !empty($tuesday->ClassSection->name) ? $tuesday->ClassSection->name : "" }} --- 
                                Subjects: {{ !empty($tuesday->subjects->name) ? $tuesday->subjects->name : "" }} Time: {{ !empty($tuesday->class_schedule) ? $tuesday->class_schedule : "" }}</span><br>
                            @endforeach

                            <h5>Wednesday Class: </h5>
                            @foreach($wednesdaysdataForTeachers as $wednesday)
                                <span>class: {{ !empty($wednesday->class) ? $wednesday->class : "" }} --- 
                                Section: {{ !empty($wednesday->ClassSection->name) ? $wednesday->ClassSection->name : "" }} --- 
                                Subjects: {{ !empty($wednesday->subjects->name) ? $wednesday->subjects->name : "" }} Time: {{ !empty($wednesday->class_schedule) ? $wednesday->class_schedule : "" }}</span><br>
                            @endforeach

                            <h5>Thursday Class: </h5>
                            @foreach($thursdaysdataForTeachers as $thursday)
                                <span>class: {{ !empty($thursday->class) ? $thursday->class : "" }} --- 
                                Section: {{ !empty($thursday->ClassSection->name) ? $thursday->ClassSection->name : "" }} --- 
                                Subjects: {{ !empty($thursday->subjects->name) ? $thursday->subjects->name : "" }} Time: {{ !empty($thursday->class_schedule) ? $thursday->class_schedule : "" }}</span><br>
                            @endforeach

                            <h5>Friday Class: </h5>
                            @foreach($fridaysdataForTeachers as $friday)
                                <span>class: {{ !empty($friday->class) ? $friday->class : "" }} --- 
                                Section: {{ !empty($friday->ClassSection->name) ? $friday->ClassSection->name : "" }} --- 
                                Subjects: {{ !empty($friday->subjects->name) ? $friday->subjects->name : "" }} Time: {{ !empty($friday->class_schedule) ? $friday->class_schedule : "" }}</span><br>
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