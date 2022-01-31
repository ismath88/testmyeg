@extends('layouts.app')

@section('content')
  <div class="ml-5 mr-5">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
            <div class="col-md-3 search-header sub-header d-flex col-12" style="display:none !important">
					<a class=""><img src="/img/srch.png">Search Institutes</a>
			</div>			
			<div class="col-md-12 col-12 ">
			<div class="col-md-12 row mt-3 col-12">
				<div class="col-md-3 mt-3">
						<div class="dropdown">
						<div class="form-group">
							<select class="form-control filter" name="account_type" id="account_type" required >
							<option value=''> group</option>
							@foreach($result['account_type'] as $key=>$value)
							<option value="{{  $value->id }}" {{ $result['acc_type'] == $value->id  ? 'selected' : ''}}>{{  $value->usergroup_name }}</option>
							@endforeach
							</select>
						</div>
						</div>
						
				</div>
				
				<div class="col-md-3 mt-3">
						<div class="dropdown">
						<div class="form-group">
							<select class="form-control filter" name="status" id="status" required >
							<option value=''> Status</option>
							<option value="4" {{ $result['approvedstatus'] == '4'  ? 'selected' : ''}}>Approved</option>
							<option value="3" {{ $result['approvedstatus'] == '3' ? 'selected' : ''}}>Pending</option>
							</select>
						</div>
						</div>
				</div>
				
				<div class="col-md-4 mt-3" >
				<!--div class="dropdown">
				<div class="form-group">
				<a href="{{ url('admin/manage_invites') }}"><button class="btn btn-primary  btn-add-more" type="button">All</button></a>
				</div>
				</div-->
				</div>
								
				
				<div class="col-md-2 mt-3">
				<div class="dropdown">
				<div class="form-group">		
				<a href="{{ url('admin/add_manageinvites') }}"><button class="btn btn-primary wrap-no btn-add-more" type="button">Add more</button></a>
				</div>
				</div>				
				</div>
				
				
				
				</div>
			
            <div class="col-md-12 col-12 px-0 mt-4">
				<div class=""> 
					<div class="card-body">
						<h5>Permissions - Invite Admin Users</h5>

						<!--table id='invites' class="table table-responsive-sm display nowrap dataTable dtr-inline collapsed"-->
						<table id='invites' class="table table-responsive display nowrap dataTable dtr-inline collapsed">
						<thead>
						<tr>
						<th>Id</th>
						<th>Name</th>
						<th>E-Mail</th>
						<th>Account Type</th>
						<th>Status</th>
						<th></th>
						</tr>
						</thead>
						<tbody>
							@foreach($result['invites'] as $key=>$value)
							 <tr>    
								  <td>{{ ($key + 1)}}</td>                  
								  <td>{{$value->name}}</td>               
								  <td>{{$value->email}}</td>                    
								  <td>{{$value->usergroup_name}}</td>                    
								  <td >{{$value->status}}</td>                    
								  <td>
								   <?php if($value->is_blocked =="0") {	 ?>
								  <a href='approve_invites/{{ $value->id }}' style="color:green" class='block' data-status='1' id="{{ $value->id }}">Unblock</a></li>
								   <?php } else  { ?>
								 
								  <a href='approve_invites/{{ $value->id }}' style="color:green" class='block' data-status='0' id="{{ $value->id }}">Block</a></li>
								  <?php } ?>
								    
								  
								   <?php if((round((strtotime(date('d-m-Y'))- strtotime($value->created_date))/24/3600) > 2) & ($value->status_id !=4)) {	 ?>
								  <a href='approve_invites/{{ $value->id }}' class='resent' data-status='2' id="{{ $value->id }}">Resent</a></li>
								   <?php } else if($value->status_id =="4")  { ?>
									
								   <?php } else { echo "Resend"; } ?>
								  
								  </td>                    
								</tr>
							@endforeach
						</tbody>
						</table>						
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script  src="{{ url('/js/parsley.min.js') }}" defer></script>
<script  src="{{ url('/js/parsley.js') }}" defer></script>
<script  src="{{ url('/js/jquery.min.js') }}"></script>
<script type="text/javascript" charset="utf8"  src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
	<script>
$( document ).ready(function() {
	$.noConflict();
	 $('#invites').DataTable(
	 {
		//"bFilter": false 
		"paging":   true,
        "ordering": true,
        "info":     false
	 });
	 $('#invites_filter').css('display','none');
	 $('.dataTables_length').css('display','none');
	 
	 
	 $(document).on('change',".filter",function(e)	
	 {
		var account_type = $('#account_type').val()?$('#account_type').val():0;
		var status = $('#status').val()?$('#status').val():0;
		var param = account_type+'-'+status;
		var filterurl = "{{ url('admin/invitesfilter') }}/"+param;
		//var filterurl = "{{ url('admin/invitesfilter') }}/"+account_type+'/'+status;
		window.location.href=filterurl;		
	 });
	
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
		var save_url ="{{ url('admin/approve_invites') }}";
				$.ajax({
				   type:'POST',
				   url:save_url,
				   data:{id:id,status:status},
				   success:function(data)
				   {
						swal({
						title: "",
						text: data.message,
						type: "success"
						});
						setTimeout(function(){ 
						var url ="{{ url('admin/manage_invites') }}";
						window.location.href=url;
						}, 2000);
			
				   }, error:function (error) {
				    var errorResponse = JSON.parse(error.responseText);
                    swal({
                        title: "",
                        text: errorResponse.message,
                        type: "error"
                    });

                    setTimeout(function(){
                        var url ="{{ url('admin/manage_invites') }}";
                        window.location.href=url;
                    }, 2000);
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
		
		var save_url ="{{ url('admin/block_invites') }}";
				$.ajax({
				   type:'POST',
				   url:save_url,
				   data:{id:id,status:status},
				   success:function(data)
				   {
						swal({
						title: "",
						text: data.message,
						type: "success"
						});
						setTimeout(function(){ 
						var url ="{{ url('admin/manage_invites') }}";
						window.location.href=url;
						}, 2000);
				   }, error:function (error) {
				    var errorResponse = JSON.parse(error.responseText);
                    swal({
                        title: "",
                        text: errorResponse.message,
                        type: "error"
                    });

                    setTimeout(function(){
                        var url ="{{ url('admin/manage_invites') }}";
                        window.location.href=url;
                    }, 2000);
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
	 
	 
	  $(".resent").click(function(e)	
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
		var save_url ="{{ url('admin/resend_invites') }}";
				$.ajax({
				   type:'POST',
				   url:save_url,
				   data:{id:id,status:status},
				   success:function(data)
				   {
						swal({
						title: "",
						text: data.message,
						type: "success"
						});
						setTimeout(function(){ 
						var url ="{{ url('admin/manage_invites') }}";
						window.location.href=url;
						}, 2000);
				   }, error:function (error) {
				    var errorResponse = JSON.parse(error.responseText);
                    swal({
                        title: "",
                        text: errorResponse.message,
                        type: "error"
                    });

                    setTimeout(function(){
                        var url ="{{ url('admin/manage_invites') }}";
                        window.location.href=url;
                    }, 2000);
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
