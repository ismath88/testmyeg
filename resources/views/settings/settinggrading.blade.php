@extends('layouts.app')

@section('content')
  <div class="container grading-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
            <div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn header" href="{{ url('account') }}">Account</a>
					<a class="select-btn header" href="{{ url('system') }}">System</a>
					<a class="select-btn header active" href="{{ url('grading') }}">Grading</a>
					<a class="select-btn header" href="{{ url('educationlevel') }}">Education level</a>
			</div>
			
			<div class="col-lg-11 col-12 ">
			<div class="col-md-12 text-right mt-3 col-12">
				<a href="{{ url('add_grading') }}"><button class="btn btn-primary" type="button">Add More</button></a>
				<a href="{{ url('upload_grading') }}"><button class="btn btn-primary" type="button">Upload CSV</button></a>
			</div>
            <div class="col-md-12 col-12 ml-lg-5 ml-0 mt-5">
				<div class="">
					<div class="card-body">
						<div class="">
						<table id='grading' class="table  display nowrap table-responsive dataTable dtr-inline collapsed">
						<thead>
						<tr>
						<th>Id</th>
						<th>Country</th>
						<th>Education Level</th>
						<th>Grading Scheme</th>
						<th>Status</th>
						<th>Action</th>
						</tr>
						</thead>
						<tbody>
						@if(count($result['grading']) > 0)
						@foreach($result['grading'] as $key=>$value)
						 <tr>    
							  <td>{{ ($key + 1)}}</td>                  
							  <td>{{$value->country_name}}</td>               
							  <td>{{$value->educationlevel_name}}</td>               
							  <td>{{$value->grading_scheme}}</td>               
							  <td>{{$value->status}}</td>
							 <td><a href="{{ url('editgrading/'.$value->id) }}" >Edit</a> | 
							
							<a class="deletegrade" href="{{ url('deletegrading/'.$value->id) }}" style="color:red; text-decoration:none;cursor:pointer">Delete</a></td>							 
							
							</tr>
						@endforeach
						@else
							<tr>    
							  <td colspan='5' align="center"> No Record found</td>                   
							</tr>
						@endif
						</tbody>
						</table>
						</div>
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script  src="{{ url('js/parsley.min.js') }}" defer></script>
<script  src="{{ url('js/parsley.js') }}" defer></script>
<script  src="{{ url('js/jquery.min.js') }}"></script>
<script type="text/javascript" charset="utf8"  src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script>
$( document ).ready(function() 
{
	$.noConflict();
	 $('#grading').DataTable(
	 {
		//"bFilter": false 
		"paging":   true,
        "ordering": true,
        "info":     false
	 });
	 $('#grading_filter').css('display','none');
	 $('.dataTables_length').css('display','none');
	 
	 
	 $(document).on('click','.deletegrade',function(e)	{	
		 var delurl = $(this).attr('href');
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
				type:'GET',
				url:delurl,
				data:{},
				success:function(data)
				{
					var response = data;
					if(response.status_code =='200')
					{
						swal({
						title: "",
						text: response.message,
						type: "success"
						});
						setTimeout(function(){ 
						var url ="{{ url('grading') }}";
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
						var url ="{{ url('grading') }}";
						window.location.href=url;
						}, 2000);		
					}

				}

			});	
			}

			else 
			{
				swal("Cancelled", "", "error");
				$('.close').trigger('click');
			}
		});
		
		//}
		return false;	 
	 });
	 
});
</script>