<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


        <a href="{{ route('home') }}" class="btn btn-info" type="submit">
        <strong> <i class="fa-solid fa-angle-double-left"></i> Back </strong>
        </a>
<h1>-----------------  Test    -----------------      </h1>
<br>
<br>


<form action="{{ route('test-data.store') }}" method="POST">
    @csrf 

    <div class="row">
  
  
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div><br>
    
  
  
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Address:</strong>
            {!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
        </div>
    </div><br>
    
  
  
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Number:</strong>
            {!! Form::text('number', null, array('placeholder' => 'Number','class' => 'form-control')) !!}
        </div>
    </div>
    </div><br>
    

    <button type="submit">Upload</button>


</form>
<h1> user list </h1>

<br>




<table class="table table-bordered">
 <tr>
   <th>name</th>
   <th>address</th>
   <th>number</th>
   <th>Action</th>
 </tr>
@foreach ($data as $key => $data)
  <tr>
    <td>{{ !empty($data->name) ? $data->name : " " }}</td>
    <td>{{ !empty($data->address) ? $data->address : " " }}</td>
    <td>{{ !empty($data->number) ? $data->number : " " }}</td>

    <td>
    {{--<a data-id="{{$data->id}}" href=""class="btn btn-danger">Delte</a>--}}

{!! Form::open(['method' => 'DELETE','route' => ['test.destroy', $data->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}


</td>

</tr>

 @endforeach

</table>







</body>
</html>