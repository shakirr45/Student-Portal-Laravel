@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  

                    <div class="container">
                        <div class="row">




                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <h3>Welcome {{ Auth::user()->name }}</h3><br>
                        </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                        <h4>Class : {{ !empty(json_decode(Auth::user()->assign_class)) ? implode(', ', json_decode(Auth::user()->assign_class)) : "" }}</h4>
                        </div>
                        </div>





                        </div>
                    </div>
                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection