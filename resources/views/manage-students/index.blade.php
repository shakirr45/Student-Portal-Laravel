@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Student Lists</h2>
            </div>
            <div class="pull-right">
                @can('class-create')
                <a class="btn btn-success" href="{{ route('manage-students.create') }}"> Create New Students</a>
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
<div class="form-box">
							
    <button type="button" class="btn btn-primary" style="font-size:12px" data-bs-toggle="collapse" data-bs-target="#demo">
            <strong><i class="fa fa-search" aria-hidden="true">search</i></strong>
        </button>
    
    <div id="demo" class="collapse">
    

            {!! Form::open(array('url' => 'manage-students', 'method' => 'get', 'id'=>'searchform', 'autocomplete' => 'off', 'name'  => 'searchform', 'class' => 'needs-validation', 'novalidate')) !!}
                
                <div class="row">
                
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="" class="form-label">User Id </label>
                            {!! Form::text('user_id', null, array('placeholder' => 'enter user id (Ex: 10)', 'required', 'class' => 'form-control application_no', 'autocomplete' => 'off')) !!}
                            
                            @error('user_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                
                <div class="text-center">
                    {{-- <a id="search_btn" href="{{ url('manage-students/') }}" class="btn submit-btn" type="submit">search</a> --}}
                    <button type="submit" class="btn submit-btn" >Search</button>
                    
                    <a id="" href="{{ url('manage-students/') }}" class="btn  btn-danger" type="reset">Cancel</a>
                </div>
            {!! Form::close() !!}
    
        <br/>
        </div>
        </div>
<!-- ================================================================= -->
<!-- ================================================================= -->
<br>
<br>
<a class="btn btn-info" href="{{ route('class-one-wise-students.index') }}">Class 1</a>
<a class="btn btn-danger" href="{{ route('class-two-wise-students.index') }}">Class 2</a>
<a class="btn btn-success" href="{{ route('class-three-wise-students.index') }}">Class 3</a>
<a class="btn btn-secondary" href="{{ route('class-four-wise-students.index') }}">Class 4</a>
<a class="btn btn-warning" href="{{ route('class-five-wise-students.index') }}">Class 5</a>


<!-- ================================================================= -->




    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>User Id</th>
            <th>Class</th>
            <th>Section</th>
            <th width="280px">Action</th>
        </tr>

        @if (isset($noDataFound) && $noDataFound)
        <div class="alert alert-info">
            No data found for the provided user ID.
        </div>
        @else
        

	    @foreach ($manageStudents as $students)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ !empty($students->user_id ) ? $students->user_id  : " " }}</td>
	        <td>{{ !empty($students->promote_class) ? $students->promote_class : " " }}</td>
	        <td>{{ !empty($students->classSection->name) ? $students->classSection->name : " " }}</td> 
	        <td>

            <form action="{{ route('manage-students.destroy',$students->id) }}" method="POST">

                   @can('manage-student-list')
                   <a class="btn btn-info" href="{{ route('manage-students.show',$students->id) }}">Show</a>
                   @endcan

                    @can('manage-student-edit')
                    <a class="btn btn-primary" href="{{ route('manage-students.edit',$students->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('manage-student-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td> 
	    </tr>
	    @endforeach
    </table>


    {!! $manageStudents->links() !!}

    @endif

@endsection