@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Classes</h2>
            </div>
            <div class="pull-right">
                @can('class-create')
                <a class="btn btn-success" href="{{ route('class-assign.create') }}"> Create New Class</a>
                @endcan
            </div>
        </div>
    </div>


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
            {{-- <th>Assign Teacher</th> --}}
            {{-- <th>Subjects</th> --}}
            {{-- <th>Day</th> --}}
            <th width="280px">Action</th>
        </tr>
	    @foreach ($classes as $class)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ !empty($class->class) ? $class->class : " " }}</td>
	        <td>{{ !empty($class->section) ? $class->section : " " }}</td>
	        {{-- <td>{{ !empty($class->userAsTeacher->name) ? $class->userAsTeacher->name : " " }}</td> --}}
	        {{-- <td>{{ !empty($class->subjects) ? $class->subjects : " "}}</td> --}}
	        {{-- <td>{{ !empty($class->days) ? $class->days : " " }}</td> --}}
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
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $classes->links() !!}


@endsection