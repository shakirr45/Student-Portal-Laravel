@extends('layouts.app')


@section('content')
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}    
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Session</th>
                <th>Session Current Year</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($sessions) && $sessions->count())
                @foreach($sessions as $key => $value)
                    <tr>
                        <td>{{ $value->session }}</td>
                        <td>{{ $value->session_year }}</td>
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

@endsection

