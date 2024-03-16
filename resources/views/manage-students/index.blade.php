@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Classes</h2>
            </div>
            <div class="pull-right">
                @can('class-create')
                <a class="btn btn-success" href="{{ route('manage-students.create') }}"> Create New Class</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif





<!-- ================================================================= -->
<!-- ================================================================= -->
<!-- ================================================================= -->

<!-- ================================================================= -->
<!-- ================================================================= -->
<!-- ================================================================= -->




    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>User Id</th>
            <th>Class</th>
            <th>Section</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($manageStudents as $students)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ !empty($students->user_id ) ? $students->user_id  : " " }}</td>
	        <td>{{ !empty($students->assign_class) ? $students->assign_class : " " }}</td>
	        <td>{{ !empty($students->section_id) ? $students->section_id : " " }}</td> 
	        <td>
            <a class="btn btn-info" href="{{ route('manage-students.show',$students->id) }}">Show</a>

            {{-- <form action="{{ route('manage-students.destroy',$students->id) }}" method="POST">

                    @can('manage-student-edit')
                    <a class="btn btn-primary" href="{{ route('manage-students.edit',$students->id) }}">Edit</a>
                    @endcan

                   


                    @csrf
                    @method('DELETE')
                    @can('manage-student-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>--}}
	        </td> 
	    </tr>
	    @endforeach
    </table>


    {!! $manageStudents->links() !!}


@endsection