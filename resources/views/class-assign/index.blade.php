    @extends('layouts.app')


    @section('content')
    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Classes</h2>
        </div>
        <div class="pull-right">
            @can('class-create')
            <a class="btn btn-warning" href="{{ route('subjects-index') }}">Add Subject +</a>
            @endcan
        </div>
        <div class="pull-right">
            @can('class-create')
            <a class="btn btn-success" href="{{ route('class-assign.create') }}">Create New Class</a>
            @endcan
        </div>
    </div>
    </div>
    <a class="btn btn-info" href="{{ route('class-assign-for-class-one.index') }}">Class 1</a>
    <a class="btn btn-danger" href="{{ route('class-assign-for-class-two.index') }}">Class 2</a>
    <a class="btn btn-success" href="{{ route('class-assign-for-class-three.index') }}">Class 3</a>
    {{--<a class="btn btn-secondary" href="{{ route('class-four-wise-students.index') }}">Class 4</a>
    <a class="btn btn-warning" href="{{ route('class-five-wise-students.index') }}">Class 5</a>--}}

    <br>

    <a href="{{ route('manage-sessions.index') }}" class="btn btn-warning">Show Session & add + </a><br>


    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif


    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Class</th>
        {{-- <th>Section</th> --}}
        {{-- <th>Assign Teacher</th>  --}}
            <th>Subjects</th>  
            {{-- <th>Day</th> --}}   
            {{-- <th>Class Schedule</th>   --}} 
        <th width="280px">Action</th>
    </tr>
    @foreach ($classes as $class)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ !empty($class->institutionClass->name) ? $class->institutionClass->name : " " }}</td>
       
        {{-- <td>{{ !empty($class->classSection->name) ? $class->classSection->name : " " }}</td>--}}
        {{-- <td>{{ !empty($class->userList->name) ? $class->userList->name : " " }}</td> --}}    
        {{-- <td>{{ !empty($class->days) ? $class->days : " " }}</td>  --}}  
        {{-- <td>{{ !empty($class->class_schedule) ? $class->class_schedule : " " }}</td> --}}   
        
        <td>{{ !empty($class->subjects->name) ? $class->subjects->name : " "}}</td>    
        
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