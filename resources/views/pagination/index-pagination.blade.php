

@if( !$data->isEmpty() )
		@php $sno =  ($data->perPage() * ($data->currentPage() - 1)) + 1; @endphp

	@foreach($data as $key => $value)
		
		<tr>
			<!--<td>
				<label class="checkboxs">
					<input type="checkbox">
					<span class="checkmarks"></span>
				</label>
			</td>-->
			{{-- <td>{{ $sno++ }}</td> --}}
			<td >{{ $value->token_no }}</td>
			<td >{{ $value->enrolled_at }}</td>

			
			<td style="text-align:right">
		

			
			@if( !empty($value->firReport) )
				<a href="{{ route('fir-reports.show', $value->id) }}">
					<strong>  <i class="fa fa-eye" aria-hidden="true"></i> View FIR</strong>
				</a>

			@else

				<a href="{{ url('fir-reports/create-custom/'.$value->id) }}">
					<strong>  <i class="fa fa-plus" aria-hidden="true"></i> Add Endorsement</strong>
				</a>
			
			@endif


				
				
			</td>
			
		</tr>
	@endforeach
	<tr>	
		<td colspan="4">
			<div id="pagination">
			  {{ $data->links("pagination::bootstrap-5") }}
			</div>
		</td>
	</tr>
	
@else
	<tr>	
		<td colspan="4" class="text-center" >
			<p class="text-danger"><b>Data Not Found !</b></p>
		</td>
	</tr>
@endif


<script src="{{ asset('public/plugins/sweetalert/sweetalert2.all.js') }}"></script>
<script src="{{ asset('public/plugins/sweetalert/sweetalerts.js') }}"></script>
   
   