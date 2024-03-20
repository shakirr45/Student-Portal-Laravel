@extends('layouts.app')


@section('content')

@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


<section class="enroll-main" style=" padding: 50px 0;">
        <div class="container">
            
			<div class="row">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="page-header" style="margin-bottom:10px">
						<div class="page-title">
							<strong>Student</strong>
							<h6 style="font-size:13px">Student</h6>
						</div>								
					</div>
				</div>
				
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" align="right">
					<div class="page-btn">
						<a href="{{ route('manage-students.index') }}" class="btn btn-info" type="submit">
						 <strong> <i class="fa-solid fa-angle-double-left"></i> Back </strong>
						</a>

						<a href="{{ route('class-one-wise-students-promote-class-all-selected') }}" class="btn btn-success" type="submit">
						 <strong> <i class="fa-solid fa-angle-double-right"></i> All Promote </strong>
						</a>


					</div>
				</div>
			</div>



            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
                    <div class="form-box">
							
						  <button type="button" class="btn btn-primary" style="font-size:12px" data-bs-toggle="collapse" data-bs-target="#demo">
								<strong><i class="fa fa-search" aria-hidden="true"></i></strong>
						   </button>
						  
						  <div id="demo" class="collapse">
						

								{!! Form::open(array('url' => 'class-one-wise-students', 'method' => 'get', 'id'=>'searchform', 'autocomplete' => 'off', 'name'  => 'searchform', 'class' => 'needs-validation', 'novalidate')) !!}
									
									<div class="row">
										
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="" class="form-label">User ID </label>
												{!! Form::text('user_id', null, array('placeholder' => 'enter User ID (Ex: 20-43543-1)', 'required', 'class' => 'form-control application_no', 'autocomplete' => 'off')) !!}
												
												@error('user_id')
													<span class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
												
											</div>
										</div>
										
										{{--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="" class="form-label">Beneficiary Name </label>
												{!! Form::text('name', null, array('placeholder' => 'enter beneficiary  name', 'required', 'class' => 'form-control application_no', 'autocomplete' => 'off')) !!}
												
												@error('name')
													<span class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
												
											</div>
										</div>--}}
										
										{{-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="" class="form-label">FIR Date </label>
												{!! Form::text('fir_date', null, array('placeholder' => 'select apply date', 'required', 'class' => 'form-control date', 'autocomplete' => 'off')) !!}
												
												@error('enrolled_at')
													<span class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
												
											</div>
										</div> --}}
									
									</div>
									
									<div class="text-center">
										<a id="search_btn" href="{{ url('class-one-wise-students/') }}" class="btn submit-btn" type="submit">search</a>
										
										<a id="" href="{{ url('class-one-wise-students/') }}" class="btn  btn-danger" type="reset">Cancel</a>
									</div>
								{!! Form::close() !!}
						
							<br/>
							</div>
						
                        <div class="table-responsive">
                            <table class="table table-hover" >
                                 <thead>
                                    <tr>
									{{-- <th scope="col">SNO</th> --}}
                                    <th scope="col" >Name</th>
                                        <th scope="col" >User ID</th>
                                        <th scope="col" >Email</th>
                                        <th scope="col" >Mobile</th>
                                        <th scope="col" >Class</th>
                                        <th scope="col" style="text-align:right">Promote Class</th>
                                    </tr>
                                </thead>
                               <tbody class="table-data" id="pagination_data">
							   
                               @include("class-wise-students.one.index-pagination",["data"=>$data]) 

										
								</tbody>
									
                            </table>
                        </div>
                        
                    </div>
					
					
                </div>
            </div>
			
        </div>
    </section>


	<script>
			
			$(function() {
				
				$(".date").datepicker({
					format: "dd-mm-yyyy",
				});
			
				$("#searchform").submit(function(){
					
					loadData();
					return false;
				});

				
				
				function loadData()
				{
					$("#pagination_data").html('<tr  align="center"><td colspan="12"><i class="fa fa-spinner fa-spin text-center" style="font-size:50px" ></i></td></tr>');
					
					var searchParams = new URLSearchParams(window.location.search);
				  
					//get url and make final url for ajax 
					var url=$("#search_btn").attr("href");
					
					var append = url.indexOf("?")==-1?"?":"&";
					var finalURL = url+append+$("#searchform").serialize();
					
						
					//set to current url
					window.history.pushState({},null, finalURL);
						
					$.get(finalURL,function(data){
					 
						$("#pagination_data").html(data);
					});
						
					
				}
				
				$(document).on("click","#btn-category a, #pagination a,#search_btn",function(){
					
					$("#pagination_data").html('<tr  align="center"><td colspan="12"><i class="fa fa-spinner fa-spin text-center" style="font-size:50px" ></i></td></tr>');
					

					var searchParams = new URLSearchParams(window.location.search);
				  
					//get url and make final url for ajax 
					var url=$(this).attr("href");
					//alert(url);
					var append=url.indexOf("?")==-1?"?":"&";
				  
					var finalURL=url+append+$("#searchform").serialize();
				
					//set to current url
					window.history.pushState({},null, finalURL);
				
					
					$.get(finalURL,function(data){
						  //console.log(data);
						$("#pagination_data").html(data);
					});
				  
					return false;
				});
				
				
		  });
		  
			
	</script>

@endsection
