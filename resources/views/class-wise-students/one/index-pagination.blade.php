

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

			<a href="#" class="btn btn-danger">Delete</a>
		
			
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


<script src="{{ asset('public/plugins/sweetalert/sweetalert2.all.js') }}"></script>
<script src="{{ asset('public/plugins/sweetalert/sweetalerts.js') }}"></script>
   
   