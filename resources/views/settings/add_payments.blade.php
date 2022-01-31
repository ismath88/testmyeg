@extends('layouts.app')

@section('content')
  <div class="container grading-page">
        <div class="fade-in">
             <div class="row">
			
			<div class="col-lg-11 col-12 ">
			<div class="col-lg-12 text-right mt-3 col-12">
				<a href="{{ url('add_manageinvites') }}"><button class="btn btn-primary" type="button">Add More</button></a>
			</div>
            <div class="col-lg-10 col-12 ml-5 mt-5">
				<div class="">
					<div class="card-body">
						<table class="table table-responsive-sm">
						<thead>
						<tr>
						<th>Id</th>
						<th>Name</th>
						<th>E-Mail</th>
						<th>Account Type</th>
						<th>Status</th>
						<th>Approved Status</th>
						</tr>
						</thead>
						<tbody>
						@if(count($result['invites']) > 0)
						@foreach($result['invites'] as $key=>$value)
						 <tr>    
							  <td>{{ ($key + 1)}}</td>                  
							  <td>{{$value->name}}</td>               
							  <td>{{$value->email}}</td>                    
							  <td>{{$value->usergroup_name}}</td>                    
							  <td>{{$value->status}}</td>                    
							  <td>
							   <?php if($value->approve_status =="4") {	 ?>
							  <a href='approve_invites/{{ $value->id }}' class='approve' data-status='2' id="{{ $value->id }}">Disapprove</a></li>
							   <?php } else  { ?>
							 
							  <a href='approve_invites/{{ $value->id }}' class='approve' data-status='4' id="{{ $value->id }}">Approve</a></li>
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
				
            </div>
            <!-- END -->
            </div>
        </div>
    </div>
</div>
@endsection
<script src="js/jquery.min.js"></script>
	<script>
$( document ).ready(function() {
	
	
	 $(".approve").click(function(e)	
	 {	
		if (confirm("Are you sure want to Approve?")) 
		{
		var id=$(this).attr("id");
		var status=$(this).attr("data-status");
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
						alert(response.message);
						var url ="{{ url('manage_invites') }}";
						window.location.href=url;
					}
					else
					{
						alert(response.message);		
					}

				   }

				});	
		
		}
		return false;	 
	 });
	
	 
		
		
});
</script>
