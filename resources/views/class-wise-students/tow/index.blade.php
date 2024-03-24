@extends('layouts.app')


@section('content')

@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
	<div id="success-message-container"></div>


<section class="enroll-main" style=" padding: 50px 0;">
        <div class="container">
            
			<div class="row">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-4">
					<div class="page-header" style="margin-bottom:10px">
						<div class="page-title">
							<a href="{{ route('manage-students.index') }}" style="text-decoration: none;"><strong>Manage Students </strong></a><strong style="font-size:13px"> / Class Tow Wise Students</strong>
						</div>								
					</div>
				</div>
				
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-8" align="right">
					<div class="page-btn">
						<a href="{{ route('manage-students.index') }}" class="btn btn-info" type="submit">
						 <strong> <i class="fa-solid fa-angle-double-left"></i> Back </strong>
						</a>



						<div class="col">
						<div class="row">

						<div class="form-group d-flex align-items-center">
						<div style="margin-top: 10px; margin-left:10px;">
						{!! Form::select('promote_section_id', ['' => 'Select Section'] + $classSection, '', array('id' => 'section_id', 'class' => 'form-select form-small select select2-hidden-accessible custom-width', 'style' => 'width: 210px;', 'tabindex' => '-1', 'aria-hidden' => 'false', 'required' => 'required')) !!}
						</div>
						<div style="margin-top: 10px; margin-left:10px;">
						<a href="#" class="btn btn-warning" id="promoteAllSelectedRecord"> <i class="fa-solid fa-angle-double-right"> <strong></i> Promote One to Tow for Selected Students</strong></a>
						</div>
						</div>

						<div class="form-group d-flex align-items-center">
						<div style="margin-top: 10px; margin-left:10px;">
						 {!! Form::open(array('route' => 'class-tow-wise-all-students-promote','method'=>'POST')) !!}
						{!! Form::select('section_id', ['' => 'Select Section']+$classSection,'', array('id' => 'section_id', 'class' => 'form-select form-small select select2-hidden-accessible custom-width','style' => 'width: 210px;', 'tabindex' => '-1', 'aria-hidden' => 'false', 'required' => 'required')) !!}
						</div>
						<div style="margin-top: 10px; margin-left:10px;">
						<button type="submit" class="btn btn-success" ><strong> <i class="fa-solid fa-angle-double-right"></i> Promote All ( Tow to Three ) . Except Demoted Students</strong></button><br>
						{!! Form::close() !!}
						</div>
						</div>

						</div>
						</div>





					</div>
				</div>
			</div>


	<div class="row" style="margin-top:30px;">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<span class="" style="background-color: #006865; padding: 10px; border-radius: 5px; width:100px; font-size:14px; color: white; font-weight: bold; margin: 2px;">Total Students : {{ $totalStudentsCount }} </span>

	<span class="" style="background-color: #820025; padding: 10px; border-radius: 5px; width:100px; font-size:14px; color: white; font-weight: bold; margin: 2px;">Total Demoted Students : {{ $totalDemotedStudentsCount }} </span>

	{{-- <span class="" style="background-color: #000068; padding: 10px; border-radius: 5px; width:100px; font-size:14px; color: white; font-weight: bold; margin: 2px;">Total Students : 10 </span> --}}

	
	</div>
	</div><br>



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
										
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="" class="form-label">Final Result</label>
												{!! Form::text('final_result', null, array('placeholder' => 'enter final result', 'required', 'class' => 'form-control application_no', 'autocomplete' => 'off')) !!}
												
												@error('final_result')
													<span class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
												
											</div>
										</div>
										
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
										<th scope="col" ><input type="checkbox" name="" id="select_all_ids"></th>
										<th scope="col" >Name</th>
                                        <th scope="col" >User ID</th>
                                        <th scope="col" >Email</th>
                                        <th scope="col" >Mobile</th>
                                        <th scope="col" >Class</th>
                                        <th scope="col" >Result</th>
                                        <th scope="col" >Status</th>
                                        <th scope="col" style="text-align:right; float:left;">Class ----------- Section ----------- Promote/Demote Class</th>
                                    </tr>
                                </thead>
                               <tbody class="table-data" id="pagination_data">
							   
							   @include("class-wise-students.tow.index-pagination", ["data" => $data, "institutionClass" => $institutionClass])


										
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

<<!-- For select all checkbox -->
<script>
    $(function() {

        $("#select_all_ids").click(function() {
            $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        });


        // For promote Selected checkbox students
        $("#promoteAllSelectedRecord").click(function(e) {
            e.preventDefault();
            var all_ids = [];

			var sectionValue = $("select[name='promote_section_id']").val(); // Get the value of the 'class' input field


            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });
            if (all_ids.length === 0) {
                alert("No selected students for promote!");
                return;
            }
            $.ajax({
                url: "{{ route('selected-class-tow-students-promote') }}", // Replace 'your_delete_route' with your actual route
                type: "GET",
                data: {
                    ids: all_ids,
					section: sectionValue, // Include the value of 'class'
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $.each(all_ids, function(key, val) {
                        $('#student_ids' + val).remove();
                    });
					if (response.message) {
                    // If there's a success message, display it in the success message container
                    $('#success-message-container').html('<div class="alert alert-success">' + response.message + '</div>');
              	  	}
					// alert("Selected Students Promoted Successfully");
                }
            });
        });
    }); 
</script>


@endsection
