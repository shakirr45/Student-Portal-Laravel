@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>subjects</h2>
            </div>
            <div class="pull-right">
                @can('class-create')
                <a class="btn btn-success" href="{{ route('class-wise-subject-assign.create') }}"> Create New Class Wise Subject</a>
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
            <th>Subject</th>
            <th>Days</th>
            <th>Assign Teacher</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($classWiseSubjectAssign as $subjects)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>
                {{ !empty($subjects->class_assign_id ) ? $subjects->class_assign_id  : " " }}
               {{-- {{ !empty($subjects->institutionClass->name ) ? $subjects->institutionClass->name  : " " }} --}}

            </td>
	        <td>{{ !empty($subjects->section_assign_id) ? $subjects->section_assign_id : " " }}</td>
	        <td>{{ !empty($subjects->subjects) ? $subjects->subjects : " " }}</td>
	        <td>{{ !empty($subjects->days) ? $subjects->days : " " }}</td>

            <td>{{ !empty($subjects->userList->name) ? $subjects->userList->name : " " }}</td>
	        <td>
                <form action="{{ route('class-wise-subject-assign.destroy',$subjects->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('class-wise-subject-assign.show',$subjects->id) }}">Show</a>
                    @can('class-wise-subject-edit')
                    <a class="btn btn-primary" href="{{ route('class-wise-subject-assign.edit',$subjects->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('class-wise-subject-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $classWiseSubjectAssign->links() !!}


@endsection