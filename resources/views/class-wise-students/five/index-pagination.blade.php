

@if( !$data->isEmpty() )
		@php $sno =  ($data->perPage() * ($data->currentPage() - 1)) + 1; @endphp

	@foreach($data as $key => $value)
		
		<tr id="student_ids{{ $value->id }}">

			{{-- <td>{{ $sno++ }}</td> --}}
			<td ><input type="checkbox" name="ids" id="ids" class="checkbox_ids" value="{{ $value->id }}"></td>
			<td >{{ $value->name }}</td>
			<td >{{ $value->user_id }}</td>
			<td >{{ $value->email }}</td>
			<td >{{ $value->mobile_no }}</td>
			<td >{{ $value->institutionClass->name }}</td>
			<td >{{ $value->final_result }}</td>
			<td >

			@if($value->demote_class == 1)
			<span style="background-color: #E51D1A; font-size:12px; color: white; font-weight: bold; border-radius: 5px; padding: 5px;">Demoted</span>
			@else
			<span style="background-color: #029B02; font-size:12px; color: white; font-weight: bold; border-radius: 5px; padding: 5px;">Promoted</span>
			@endif

			
			<td style="text-align:right">

			<form method="POST" action="{{ route('class-five-single-student-wise-promote-class', $value->id) }}">
				@csrf
			
			<div class="form-group d-flex align-items-center">
				{{--<strong>{{ $value->institutionClass->name }} to</strong>
				<?php
				// Increment the value of $value->promote_class by 1
				$value->promote_class += 1;
				?>--}}

				{{--<div class="" style="margin-left:10px;">
				{!! Form::select('promote_class', ['' =>'Select One'] + $institutionClass, $value->promote_class, array('id' => 'section', 'class' => 'form-select', 'single' => 'single', 'required')) !!}
				</div> --}}

				<div class="" style="margin-left:10px;">
				{!! Form::select('section_id', ['' =>'Select One'] + $classSection, $value->section_id, array('id' => 'section', 'class' => 'form-select', 'single' => 'single', 'required')) !!}
				</div>


				<div class="" style="margin-left:10px;">
				<button class="btn btn-primary" type="submit">Promote </button>
				</div>

			</form>

			@if($value->demote_class == 0)
			<form method="POST" action="{{ route('class-five-wise-students-demote-status', $value->id) }}">
			@csrf
				<div class="" style="margin-left:10px;">
				<button class="btn btn-danger" type="submit">Demote Status</button>
				</div>
			</form> 
			@else 
			<form method="POST" action="{{ route('class-five-wise-students-promote-status', $value->id) }}">
			@csrf
				<div class="" style="margin-left:10px;">
				<button class="btn btn-success" type="submit">Promote Status</button>
				</div>
			</form> 
			@endif

			</div>




			{{-- <form method="POST" action="{{ route('class-five-wise-students.destroy', $value->id) }}">

				@csrf
				@method('DELETE')
				<button class="btn btn-danger" type="submit">Delete</button>
			</form> --}}

			</td>
			
		</tr>
	@endforeach
	<tr>	
		<td colspan="12">
			<div id="pagination">
			  {{ $data->links("pagination::bootstrap-5") }}
			</div>
		</td>
	</tr>
	
@else
	<tr>	
		<td colspan="12" class="text-center" >
			<p class="text-danger"><b>Data Not Found !</b></p>
		</td>
	</tr>
@endif


   
   