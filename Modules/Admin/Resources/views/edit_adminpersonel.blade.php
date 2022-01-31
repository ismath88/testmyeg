@extends('layouts.app')

@section('content')
<style>
.parsley-required
{
	color:red;
}
.parsley-type
{
	color:red;
}
.parsley-min
{
	color:red;
}
.parsley-minlength
{
	color:red;
}
.parsley-equalto
{
	color:red;
}
.required,.error_new,.error_confirm,.error_cur
{
	color:red;
}
.invalid_password
{
	color:red;
}
</style>
  <div class="container grading-page">
        <div class="fade-in">
             <div class="row">
			
            <div class="collg-7 col-10 ml-5 mt-5">
				<form action='#' class="store_invites_form" method="post" >
				{{ csrf_field() }}
					<div class="card">
                    <div class="card-header"><strong>Update Invite Admin Users</strong></div>
                        <div class="card-body">
                            <form action="" method="post">
								<div class="form-group">
                                    <label for="nf-password">Name</label>
									<input class="form-control id" type="hidden" name="id" autocomplete="id" value="{{ $result['invite']->id }}" >
                                    <input class="form-control name" id="nf-title" type="text" name="name" autocomplete="name" value="{{ $result['invite']->name }}" required>
                                </div>
								<div class="form-group">
                                    <label for="nf-password">Email</label>
                                    <input class="form-control email" id="nf-title" type="email" name="email" autocomplete="email" value="{{ $result['invite']->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nf-password">Account Type</label>
									<select class="form-control account_type" name="account_type" required>
									<option>Select group</option>
									@foreach($result['account_type'] as $key=>$value)
									<option value="{{  $value->id }}" {{ $result['invite']->account_type == $value->id  ? 'selected' : ''}}>{{  $value->usergroup_name }}</option>
						            @endforeach
									</select>
                                </div>
                                
								 <div class="form-group">
                                    <label for="nf-password">Message</label>
									<textarea class="form-control message" rows="10" id="txtmsg" name="message" autocomplete="message" placeholder="" required>{{ $result['invite']->message }}</textarea>
									
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
						 <button class="btn btn-sm btn-danger deleteinvite" type="button"> Delete </button>
						    <button class="btn btn-sm btn-primary backbtn" type="button"> Back </button>
                            <button class="btn btn-sm btn-primary store_invites" type="button"> Submit</button>
                        </div>
                </div>
				</form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script  src="{{ url('/js/parsley.min.js') }}" defer></script>
<script  src="{{ url('/js/parsley.js') }}" defer></script>
<script  src="{{ url('/js/jquery.min.js') }}"></script>
	<script>
$( document ).ready(function() {
	
	$(".backbtn").click(function(e)	{	
	    
			var url ="{{ url('admin/adminpersonnel') }}";
			window.location.href=url;
						
	 });
	 
	
	 $(".store_invites").click(function(e)	{		
        e.preventDefault();
        var email = $('.email').val();
		var form =$(".store_invites_form");
		var form =$(".store_invites_form");
		var formdata = $(".store_invites_form").serialize();
		var form = $(".store_invites_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			var save_url ="{{ url('admin/update_invites') }}";
			var formdata = $(".store_invites_form").serialize();
				$.ajax({
				   type:'POST',
				   url:save_url,
				   data:formdata,
				   success:function(data)
				   {

					var response = data;

					if(response.status_code ='200')
					{
					    swal({
							title: "",
							text: response.message,
							type: "success"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('admin/adminpersonnel') }}";
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
							var url ="{{ url('admin/adminpersonnel') }}";
							window.location.href=url;
						   }, 2000);		
					}

				   }

				});	
		}
				
		});
		
		
		
		$(document).on('click','.deleteinvite',function(e)	{	
		 var delurl ="{{ url('del_invites') }}" + '/' + $('.id').val();
		// alert(delurl);
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
						var url ="{{ url('admin/adminpersonnel') }}";
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
						var url ="{{ url('admin/adminpersonnel') }}";
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
