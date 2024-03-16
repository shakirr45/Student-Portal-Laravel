<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Saint Rita's High School</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('public/nbt/assets/scss/style.css') }}">
	
	
	<link rel="stylesheet" href="{{ asset('public/css/style.css') }}"> 
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<!-- start toast -->
    <!-- Not Mandatory for this project<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">-->  
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> 
	<!-- end toast -->
   
	<!-- start toast -->
    <!-- Not Mandatory for this project<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">-->  
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> 
	<!-- end toast -->
    
	
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"rel="stylesheet"/>
    
	<link rel="stylesheet" href="{{ asset('public/mine/assets/plugins/select2/css/select2.min.css') }}">
    
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
	<script src="{{ asset('public/nbt/assets/js/nbt-custom.js') }}"></script>
    
	<!--text editor -->
		
    <!--<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>  -->
	<script src="https://cdn.tiny.cloud/1/7hsc6gz40a0w3esa37qtgg013xpfxbo79hnj8zc9ih8wtqvj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
 

	<!--end text editor -->
	
	<style>
		.invalid-feedback{display:block}
		.toast-success{width:350px !important;background:#14c823; margin-top:95px !important}
		.toast-error{width:350px !important;margin-top:95px !important}
		.text-none-transfrom{text-transform: none !important}
		th{font-size: 14px}
		.form-control-sm{padding:0px !important; }
	</style>
</head>

<body>
	    <section class="main-navbar">
        <nav class="navbar navbar-expand-lg fixed-top" id="navbar_top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('dashboard/') }}">Login as </a>
                
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
				

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">

					
					<li class="nav-item dropdown">
                            <a class="nav-link " href="" role="button" >
                                <i class="fa-solid fa-eye" style="margin-top:3px"></i> Current Token
                            </a>
                        </li>

						<!-- ////////----------------------------------------  -->
						{{-- <li class="nav-item dropdown">
                            <a class="nav-link " href="{{ route('check.notification') }}" role="button" >
                                <i class="fa-solid fa-eye" style="margin-top:3px"></i> Notification
                            </a>
                        </li> --}}
						<!-- ////////----------------------------------------  -->


					<li class="nav-item dropdown">
                            <a class="nav-link " href="" role="button" >
                                <i class="fa-solid fa-eye" style="margin-top:3px"></i> Query
                            </a>
                        </li>



						{{-- @can('application-query-list')
						<li class="nav-item dropdown">
                            <a class="nav-link " href="{{ url('application-query-list') }}" role="button" >
                                <i class="fa-solid fa-search" style="margin-top:3px"></i> Query
                            </a>
                        </li>
						@endcan --}}
						
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Actions
                            </a>
                            <ul class="dropdown-menu">
								
							@can('application-enrollment-list')
								<li>
									<a class="dropdown-item" href="{{ url('service-tokens') }}">
										<i class="fa-solid fa-eye" style="margin-top:3px"></i> 
										&nbsp;  Tokens
									</a>


							@endcan

							</li>
								<a class="dropdown-item" href="{{ url('fir-reports') }}">
										<i class="fa-solid fa-eye" style="margin-top:3px"></i> 
										&nbsp;  FIR List
									</a>
								</li>
								
						{{--
							@can('application-receiving-list')	
								<li>
									<a class="dropdown-item" href="{{ url('application-receiving-list') }}"> 
										<i class="fa-solid fa-chevron-circle-down" style="margin-top:3px"></i> &nbsp; 
										Received Applications  
									</a>
								</li>
							@endcan
								

							
							@can('application-sending-list')
								<li>
									<a class="dropdown-item" href="{{ url('application-sending-list') }}"> 
										<i class="fa-solid fa-paper-plane" style="margin-top:3px"></i> 
										&nbsp; Sent Application 
									</a>
								</li>
							@endcan
							
							@can('application-approve-down-list')
							<li>
								<a class="dropdown-item" href="{{ url('application-approved-sending-list') }}"> 
									<i class="fa-solid fa-check-square" style="margin-top:3px"></i> 
									&nbsp;  Approved & Down Applications
								</a>
							</li>
							@endcan
							
							@can('application-objection-down-list')
								<li>
									<a class="dropdown-item" href="{{ url('application-objection-sending-list') }}"> 
										<i class="fa-solid fa-exclamation-triangle" style="margin-top:3px;">
										</i> &nbsp;  Objection & Down Applications
									</a>
								</li>
							@endcan
						--}}
							
                            </ul>
                        </li>
						
						@can( 'visa-category-list', 'noting-category-list', 'country-list', 'role-list', 'user-list' )
						{{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Settings
                            </a>
                            <ul class="dropdown-menu">
								
								@can('visa-category-list')
									<li>
										<a class="dropdown-item" href="{{ url('visa-categories') }}"> 
											<i class="fa-solid fa-clone" style="margin-top:3px"></i> &nbsp; 
											Visa Category 
										</a>
									</li>
								@endcan
								
								@can('noting-category-list')
									<li>
										<a class="dropdown-item" href="{{ url('noting-categories') }}"> 
											<i class="fa-solid fa-sticky-note" style="margin-top:3px"></i> &nbsp; 
											Noting Category 
										</a>
									</li>
								@endcan
								
								
								@can('country-list')
									<li>
										<a class="dropdown-item" href="{{ url('countries') }}"> 
											<i class="fa-solid fa-globe" style="margin-top:3px"></i> &nbsp; Country
										</a>
									</li>
								@endcan
								
								@can('objection-category-list')
									<li>
										<a class="dropdown-item" href="{{ url('objection-categories') }}"> 
											<i class="fa-solid fa-sticky-note" style="margin-top:3px"></i> &nbsp; 
											Objection Category 
										</a>
									</li>
								@endcan  
							

                            </ul>
                        </li> --}}
						@endcan
						
						
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" title ="">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu">
								
								@can('role-list')
									<li>
										<a class="dropdown-item" href="{{ url('roles') }}"> 
											<i class="fa-solid fa-cog" style="margin-top:3px"></i> &nbsp; Roles
										</a>
									</li>
								@endcan
								
								@can('user-list')
									<li>
										<a class="dropdown-item" href="{{ url('users') }}"> 
											<i class="fa-solid fa-user-friends" style="margin-top:3px"></i> &nbsp; Users 
										</a>
									</li>
								@endcan
								
								
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"

                                       onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">

                                        <i class="fa-solid fa-power-off" style="margin-top:4px;color:red"></i> &nbsp;  {{ __('Logout') }}

                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                                        @csrf

                                    </form>
                                </li>

                            </ul>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </section>


    {{----@yield('content') --}}

    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->


    <section class="enroll-main" style=" padding: 50px 0;">
        <div class="container">
            
			<div class="row">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="page-header" style="margin-bottom:10px">
						<div class="page-title">
							<strong>Tokens</strong>
							<h6 style="font-size:13px">Manage Token</h6>
						</div>								
					</div>
				</div>
				
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" align="right">
					<div class="page-btn">
						<a href="{{ url('dashboard/') }}" class="btn btn-success" type="submit">
						 <strong> <i class="fa-solid fa-angle-double-left"></i> Back </strong>
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
						

								{!! Form::open(array('url' => 'service-tokens', 'method' => 'get', 'id'=>'searchform', 'autocomplete' => 'off', 'name'  => 'searchform', 'class' => 'needs-validation', 'novalidate')) !!}
									
									<div class="row">
									
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="" class="form-label">Token No. </label>
												{!! Form::text('token_no', null, array('placeholder' => 'enter token number (Ex: 10)', 'required', 'class' => 'form-control application_no', 'autocomplete' => 'off')) !!}
												
												@error('token_no')
													<span class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
												
											</div>
										</div>
										
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="" class="form-label">Date </label>
												{!! Form::text('enrolled_at', null, array('placeholder' => 'select apply date', 'required', 'class' => 'form-control date', 'autocomplete' => 'off')) !!}
												
												@error('enrolled_at')
													<span class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
												
											</div>
										</div>
									
									</div>
									
									<div class="text-center">
										<a id="search_btn" href="{{ url('service-tokens/') }}" class="btn submit-btn" type="submit">search</a>
										
										<a id="" href="{{ url('service-tokens/') }}" class="btn  btn-danger" type="reset">Cancel</a>
									</div>
								{!! Form::close() !!}
						
							<br/>
							</div>
						
                        <div class="table-responsive">
                            <table class="table table-hover" >
                                 <thead>
                                    <tr>
									{{-- <th scope="col">SNO</th> --}}
                                        <th scope="col" >Token No.</th>
                                        <th scope="col" >Date & Time</th>
                                        <th scope="col" style="text-align:right">action</th>
                                    </tr>
                                </thead>
                               <tbody class="table-data" id="pagination_data">
							   
										{{--@include("pagination.index-pagination",["data"=>$data]) --}}
										
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
					$("#pagination_data").html('<tr  align="center"><td colspan="3"><i class="fa fa-spinner fa-spin text-center" style="font-size:50px" ></i></td></tr>');
					
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
					
					$("#pagination_data").html('<tr  align="center"><td colspan="3"><i class="fa fa-spinner fa-spin text-center" style="font-size:50px" ></i></td></tr>');
					

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





    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->

    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
    <!-- ======================================================= -->
	
	<br/>
    <section class="footer-main fixed-bottom mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--<p>©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> SB Report Tracker. All Rights
                        Reserved. Developed by <a href="#"> North Bengal
                            Technology-NBT</a>
                    </p>-->
					
					<p class="text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Smart Policing  Software. Developed by <a href="https://northbengaltech.com/"  target="_blank">NBT</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script src="{{ asset('public/nbt/assets/js/custom.js') }}"></script>
	
	<script src="{{ asset('public/mine/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{ asset('public/mine/assets/plugins/select2/js/custom-select.js') }}"></script>
</body>

</html>


 <!-- start toast -->
 <script>

	@if(Session::has('success'))
		toastr.options =
		  {
			"closeButton" : true,
			"progressBar" : true
		  }
		toastr.success("{{ session('success') }}");
		
	@endif

	@if(Session::has('error'))
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
		toastr.error("{{ session('error') }}");
	@endif
	
	$(function () {
		$("body").tooltip({ selector: '[data-toggle=tooltip]',placement: 'left' });
	});
	
	
	$(".date").datepicker({
		format: "dd-mm-yyyy",
	});
			
	
	
</script>
<!-- end toast -->