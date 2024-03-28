<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 CRUD Application - ItSolutionStuff.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>
    
<div class="container">
    <h1>Laravel 8 Pagination Example - ItSolutionStuff.com</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th width="300px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($sessions) && $sessions->count())
                @foreach($sessions as $key => $value)
                    <tr>
                        <td>{{ $value->session }}</td>
                        <td>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
        </tbody>
    </table>
         
    {!! $sessions->links() !!}
</div>
     
</body>
</html>