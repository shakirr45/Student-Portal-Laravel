@extends('layouts.app')


@section('content')
<section class="enroll-main" style=" padding: 50px 0;">
        <div class="container">


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Class One Wise Classes</h2>
            </div>

            <a href="{{ route('class-assign.index') }}" class="btn btn-info" type="submit">
                <strong> <i class="fa-solid fa-angle-double-left"></i> Back </strong>
            </a>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Class</th>
            <th>Section</th>
            <th>Assign Teacher</th> 
             <th>Subjects</th>  
             <th>Day</th>   
             <th>Class Schedule</th>   
             {{--<th width="280px">Action</th>--}}
        </tr>
	    @foreach ($classes as $class)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ !empty($class->institutionClass->name) ? $class->institutionClass->name : " " }}</td>
	        <td>{{ !empty($class->classSection->name) ? $class->classSection->name : " " }}</td>
	        <td>{{ !empty($class->userList->name) ? $class->userList->name : " " }}</td> 
	         <td>{{ !empty($class->subjects->name) ? $class->subjects->name : " "}}</td>    
	         <td>{{ !empty($class->days) ? $class->days : " " }}</td>   
	         <td>{{ !empty($class->class_schedule) ? $class->class_schedule : " " }}</td>   
	        {{--<td>
                <form action="{{ route('class-assign.destroy',$class->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('class-assign.show',$class->id) }}">Show</a>
                    @can('class-edit')
                    <a class="btn btn-primary" href="{{ route('class-assign.edit',$class->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('class-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>--}}
	    </tr>
	    @endforeach
    </table>


    {!! $classes->links() !!}


    </div>
    </div>

@endsection