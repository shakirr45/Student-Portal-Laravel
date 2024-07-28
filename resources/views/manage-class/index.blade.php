@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Classes</h2>
            </div>
            <div class="pull-right">
            {{-- @can('class-create')
                <a class="btn btn-success" href="{{ route('class-assign.create') }}"> Create New Class</a>
                @endcan--}}
            </div>
        </div>
    </div>
        <a class="btn btn-info" href="{{ route('manage-class-one.index') }}">Class 1</a>
        <a class="btn btn-danger" href="{{ route('manage-class-two.index') }}">Class 2</a>
        <a class="btn btn-success" href="{{ route('manage-class-three.index') }}">Class 3</a>
        {{--  <a class="btn btn-danger" href="{{ route('manage-class-two.index') }}">Class 2</a>--}}


    <br>

{{--    <a href="{{ route('manage-sessions.index') }}" class="btn btn-warning">Show Session & add + </a><br>
--}}

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
            <th>Subjects</th> 
            <th>Class Schedule</th>   
            <th>Assign Teacher</th> 
            <th>Days</th>   
             {{-- <th>Subjects</th>  
            <th width="280px">Action</th>--}}
        </tr>
	    @foreach ($manageClassData as $data)
	    <tr>
         <td>{{ ++$i }}</td>  
	        <td>{{ !empty($data->class) ? $data->class : " " }}</td>
            <td>{{ !empty($data->classSection->name) ? $data->classSection->name : " " }}</td>
	        <td>{{ !empty($data->subjects->name) ? $data->subjects->name : " " }}</td> 
            <td>{{ !empty($data->class_schedule) ? $data->class_schedule : " " }}</td>
            <td>{{ !empty($data->userList->name) ? $data->userList->name : " " }}</td>
            <td>{{ !empty($data->days) ? $data->days : " " }}</td>      
            {{--<td>{{ !empty($class->subjects->name) ? $class->subjects->name : " "}}</td>--}}    
             {{--
                  <td>
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


   {!! $manageClassData->links() !!}


@endsection