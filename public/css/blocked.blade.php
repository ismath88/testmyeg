@extends('layouts.app')

@section('content')
  <div class="ml-5 mr-5">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
            <div class="col-md-3 search-header sub-header d-flex col-12">
					<a class=""><img src="img/srch.png">Search Institutes</a>
			</div>
			
			<div class="col-md-12 col-12 ">
			<div class="col-md-12 row mt-3 col-12">
				<!--<div class="col-md-6 ">
					<div class="dropdown d-inline-block">
						<button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Type</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin: 0px;"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
						</div>

						<div class="dropdown d-inline-block">
						<button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Name</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin: 0px;"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
						</div>

						<div class="dropdown d-inline-block">
						<button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Country</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin: 0px;"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
						</div>

				</div>-->
				<div class="col-md-12 text-right">
				<!--<button class="btn btn-primary" type="button">Add Invite</button>-->
				<div class="btn-group ml-2">
                          <button class="btn btn-secondary hdr-lft-btn" type="button">Recently</button>
                          <button class="btn btn-secondary dropdown-toggle hdr-lft-btn dropdown-toggle-split" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
                          <!--<div class="dropdown-menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
                          </div>
                        </div>-->
				</div>
			</div>
            <div class="col-md-12 col-12 px-0 mt-4">
				<div class="">
					<div class="card-body">
						<h5>BLOCKED UNIVERSITIES</h5>
						<table id="blockeduniv" class="table table-responsive-sm display nowrap dataTable dtr-inline collapsed">
						<thead>
							<tr>
								<th>Date</th>
								<th>Institutes ID</th>
								<th>Logo</th>
								<th>Name</th>
								<th>Type</th>
								<th>Country</th>
								<th>No. of Program</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@if(count($result) > 0)
							@foreach($result as $key=>$value)
							<tr>
								<td>{{ \Carbon\Carbon::parse($value->created_at)->format('d/m/Y')}}</td>
								<td>{{$value->university_id}} </td>              
							  	<td><img src="/img/logo_01.png">{{$value->logo_image}}</td>               
							  	<td>{{$value->institute_name}}</td>
								<td>{{ ucfirst($value->institute_type) }}</td>                  
							 	<td><img src="/img/aus_cntry.png"> {{$value->country_name}}</td> 
								<td>0</td>                   
								<td>
								<div class="btn-group ml-2">
									@if($value->status == '2')
										<button class="btn btn-secondary" type="button">Blocked</button>

										<div class="dropdown-menu">
											<a class="dropdown-item status" href="javascript:;" data-status='1' id="{{ $value->university_id }}">Unblock</a>
										</div>
										  
									@endif

									<button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="sr-only">Toggle Dropdown</span>
									</button>
                        		</div>
								</td>

							</tr>
							@endforeach
							@else
							<tr>    
								<td colspan="7" align="center"> No Records found</td>                   
							</tr>
							@endif
						 <!--<tr>    
							  <td>10/10/2020</td>                  
							  <td>289822</td>               
							  <td><img src="/img/logo_01.png"></td>               
							  <td>Deakin University</td>               
							  <td>University</td>                     
							  <td><img src="/img/aus_cntry.png">Australia</td>                     
							  <td>25</td>                     
							  <td>Paid</td>                     
							  <td><div class="btn-group ml-2">
                          <button class="btn btn-secondary" type="button">Pending</button>
                          <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
                          <div class="dropdown-menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
                          </div>
                        </div> <span> <img src="/svg/delete_icn.svg"></span> </td>                     
							</tr>
							<tr>    
							  <td colspan='9' align="center"> No Record found</td>                   
							</tr>-->
						</tbody>
						</table>
						<!--{{-- $result->links() --}}-->
						
						</div>
                </div>
				</div>
				
            </div>
            <!-- END -->
            </div>
        </div>
    </div>
</div>
@endsection


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script  src="{{ url('js/jquery.min.js') }}"></script>

<script type="text/javascript" charset="utf8"  src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function()
{
	$.noConflict(); 

	 $('#blockeduniv').DataTable(
	 {
		//"bFilter": false 
		"paging":   true,
        "ordering": true,
		"info":     false,
		"order": [0,'desc'],
		"columnDefs": [
			{ "orderable": false, "targets": [ 7 ] }			
		 	]
	 });

	$('#blockeduniv_filter').css('display','none');
	$('#blockeduniv_length').css('display','none');
	 
	 $(".status").click(function(e)	
	 {	
		//if (confirm("Are you sure want to continue?")) {

		var id = $(this).attr("id");
		var status = $(this).attr("data-status");
		var pageno = $(this).attr("data-page");
		var save_url = "{{ url('statusbchange') }}";	

		swal({
			title: "",
			text: "Are you sure want to continue?",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm) 
		{
			if (isConfirm) 
			{			

			$.ajax({
				type:'POST',
				url:save_url,
				data:{id:id,status:status},
				success:function(data)
				{
					var response = JSON.parse(data);
					if(response.status_code =='200')
					{
						swal({
						title: "",
						text: response.message,
						type: "success"
						});
						setTimeout(function(){ 
						var url ="{{ url('universities-blocked') }}";
						window.location.href=url;
						}, 2000);
					}
					else
					{
						swal({
						title: "",
						text: response.message,
						type: "error"
						});
						setTimeout(function(){ 
						var url ="{{ url('universities-blocked') }}";
						window.location.href=url;
						}, 2000);		
					}

				}

			});	

			}

			else 
			{
				swal("Cancelled", "", "error");
			}
		});
		
		//}
		return false;	

	 });
	 
		
		
});
</script>