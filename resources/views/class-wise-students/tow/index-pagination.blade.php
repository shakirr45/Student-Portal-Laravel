

@if( !$data->isEmpty() )
		@php $sno =  ($data->perPage() * ($data->currentPage() - 1)) + 1; @endphp

	@foreach($data as $key => $value)
		
		<tr>

			{{-- <td>{{ $sno++ }}</td> --}}
			<td >{{ $value->name }}</td>
			<td >{{ $value->user_id }}</td>
			<td >{{ $value->email }}</td>
			<td >{{ $value->mobile_no }}</td>
			<td >{{ $value->institutionClass->name }}</td>
			
			<td style="text-align:right">



			<form method="POST" action="{{ route('class-one-wise-students-promote-class', $value->id) }}">
				@csrf
			
			<div class="">
				<span>{{ $value->assign_class }} to</span>
				<input type="text" name="promote_class" value="{{ (int)$value->assign_class + 1 }}" style="width: 50px;">

			<button class="btn btn-primary" type="submit">Promote </button>
			</div>

			</form>



			{{-- <form method="POST" action="{{ route('class-one-wise-students.destroy', $value->id) }}">

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


   
   