@extends('layouts.app')

@section('content')
  <div class="container-fluid">
        <div class="fade-in">
             <div class="row">
			 <div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn header" href="{{ url('account') }}">Account</a>
					<a class="select-btn header" href="{{ url('system') }}">System</a>
					<a class="select-btn header" href="{{ url('grading') }}">Grading</a>
					<a class="select-btn header active" href="{{ url('educationlevel') }}">Education level</a>
				</div>
			
			<div class="col-lg-11 col-12 ">
			<div class="col-md-12 text-right mt-3 col-12">
				<a href="{{ url('add_educationlevel') }}"><button class="btn btn-primary" type="button">Add More</button></a>
				<a href="{{ url('upload_educationlevel') }}"><button class="btn btn-primary" type="button">Upload CSV</button></a>
			</div>
            <div class="col-md-12 col-12 ml-lg-5 ml-0 mt-5 ">
				
					<div class="card-body table-responsive">
						<table class="table  educationlevel" id="educationlevel">
						<thead>
						<tr>
						<th>S.NO</th> 
						<th>Country</th>
						<th>Education Level</th>
						<th>Main Level</th>
						<th>Status</th>
						<th>Action</th>
						<th></th>
						</tr>
						</thead>
						<tbody>
						@if(count($result['educationlevellevel']) > 0)
						@foreach($result['educationlevellevel'] as $key=>$value)
						 <tr>    
							  <td>{{ ($key + 1)}}</td>                  
							  <td>{{$value->country_name}}</td>               
							  <td>{{$value->educationlevel_name}}</td>               
							  <td>{{$value->level_name}}</td>                    
							  <td>{{$value->status}}</td>                    
							  <td>
							  <a href="{{ url('edit_educationlevel/'.$value->id) }}" >Edit</a> |
							  <a class="deleteedu" href="{{ url('del_education/'.$value->id) }}" style="color:red; text-decoration:none;cursor:pointer">Delete</a>
							  </td>
							  <td>
							  <?php if($value->stat =="0") { ?>
							  <a class='delete' data-status='1' id="{{ $value->id }}" style="cursor:pointer;color:red">Activate</a>
							  <?php } else { ?>
							  <a class='delete' data-status='0' id="{{ $value->id }}" style="cursor:pointer;color:green">Deactivate</a> 
							  <?php } ?>
							  </td>                    
							</tr>
						@endforeach
						@else
							<tr>    
							  <td colspan='6' align="center"> No Record found</td>                   
							</tr>
						@endif
						</tbody>
						</table>
						<!--ul class="pagination">
						<li class="page-item"><a class="page-link" href="#">Prev</a></li>
						<li class="page-item active"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">4</a></li>
						<li class="page-item"><a class="page-link" href="#">Next</a></li>
						</ul-->
						
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
$( document ).ready(function() {
	$.noConflict();
	 $('#educationlevel').DataTable(
	 {
		//"bFilter": false 
		"paging":   true,
        "ordering": true,
        "info":     false
	 });
	 
	 $('#educationlevel_filter').css('display','none');
	 $('.dataTables_length').css('display','none');
	
	 $(".approve").click(function(e)	
	 {	
		
		var id=$(this).attr("id");
		var status=$(this).attr("data-status");
		swal({
        title: "",
        text: "Do you want to continue?",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) 
		{
		var save_url ="{{ url('approve_invites') }}";			
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
						var url ="{{ url('manage_invites') }}";
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
						var url ="{{ url('manage_invites') }}";
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
	 
	 
	 $(".block").click(function(e)	
	 {	
	 var id=$(this).attr("id");
		var status=$(this).attr("data-status");
		swal({
        title: "",
        text: "Do you want to continue?",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) 
		{
		
		var save_url ="{{ url('block_invites') }}";			
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
						var url ="{{ url('manage_invites') }}";
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
						var url ="{{ url('manage_invites') }}";
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
	 
	 
	  $(".delete").click(function(e)	
	 {	
		var id=$(this).attr("id");
		var status=$(this).attr("data-status");
		swal({
        title: "",
        text: "Do you want to continue?",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) 
		{
		var save_url ="{{ url('delete_educationlevel') }}";			
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
						var url ="{{ url('educationlevel') }}";
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
						var url ="{{ url('educationlevel') }}";
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
	
	 
	 
	  $(document).on('click','.deleteedu',function(e)	{	
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
						var url ="{{ url('educationlevel') }}";
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
						var url ="{{ url('educationlevel') }}";
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