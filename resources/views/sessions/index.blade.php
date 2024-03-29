@extends('layouts.app')


@section('content')
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}    

<section class="enroll-main" style=" padding: 50px 0;">
<div class="container">
<div id="success-message-container"></div>


<button  type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">
    Add Session +
</button>

<a href="{{ route('class-assign.index') }}" class="btn btn-info" style="float:right; margin-bottom:20px;" type="submit">
    <strong> <i class="fa-solid fa-angle-double-left"></i> Back </strong>
</a>



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
                            <button data-id="{{ $value->id }}" class="btn btn-danger delete_session">Delete</button>
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

</div>

@include('sessions.session-add-mode')

</section>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<!-- Add session with ajax  -->
<script>
    $(document).ready(function (){

        $(document).on('click', '.add_session', function(e){
            e.preventDefault();
            let session = $('#session').val();
            let session_year = $('#session_year').val();

            // console.log(session);

            $.ajax({
                type: "post",
                url: "{{ route('manage-sessions.store') }}",
                data: {session:session, session_year},
                dataType: "json",

                success: function (response) {
                    if (response.status=='success') {
                    $('#addModal').modal('hide');
                    $('#exampleModal')[0].reset();
                    $('.table').load(location.href+' .table');
                 }
                 if (response.message) {
                    // If there's a success message, display it in the success message container
                    $('#success-message-container').html('<div class="alert alert-success">' + response.message + '</div>');
              	  	}
                },error: function (err) {
               let error=err.responseJSON;
               $.each(error.errors,function(index,value){
                $('.errmsg').append('<span class="text-danger">'+value+'</span>'+'<br>');
               })
            }

            });
        });

        // For delete session ====>
        $(document).on('click', '.delete_session', function(e){
            e.preventDefault();
            let session_id = $(this).data('id');

            // console.log(session_id);
            $.ajax({
                type: "DELETE",
                url: "{{ route('manage-sessions-destroy') }}",
                data: {session_id:session_id},
                dataType: "json",

                success: function(response) {
                    console.log(response);
                    
                    if (response.status=='success') {
                    $('.table').load(location.href+' .table');
                    }

                    if(response.message){
                    $('#success-message-container').html('<div class="alert alert-success">' + response.message + '</div>');
                    }

                }

            });

        });




    });

</script>
@endsection

