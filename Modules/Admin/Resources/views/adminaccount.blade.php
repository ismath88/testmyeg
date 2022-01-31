@extends('layouts.app')

@section('content')
  <div class="container account-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
				<div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn">Account</a>
					<a class="select-btn">System</a>
					<a class="select-btn active">Grading</a>
					<a class="select-btn">Education level</a>
				</div>
			
			<div class="col-md-10 col-12 ">
            <div class="col-md-7 col-12 ml-5 mt-5">
			<form action='#' class="reset_email_form" method="post" >
				{{ csrf_field() }}
					<div class="card">
                    <div class="card-header"><strong>Profile</strong></div>
					<input class="form-control" id="nf-id" type="hidden" name="id" autocomplete="id" value="{{ $result['user']->id }}">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="nf-email">Email</label>
									@if($result['user']->communicate_email =="") 
                                    <input class="form-control email" id="nf-email" type="email" name="email" autocomplete="email" value="{{ $result['user']->email }}">
									@else
									<input class="form-control email" id="nf-email" type="email" name="email" autocomplete="email" value="{{ $result['user']->communicate_email }}">
									@endif
                                </div>
                                
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-sm btn-primary reset_email" type="button"> Submit</button>
                           <!-- <button class="btn btn-sm btn-danger" type="reset"> Reset</button>  -->
                        </div>
                </div>
				</form>
				</div>
				<div class="col-md-7 col-12 ml-5 mt-5">
				<form action='#' class="update_password_form" method="post" >
				{{ csrf_field() }}
					<div class="card">
                    <div class="card-header"><strong>Password</strong></div>
					<input class="form-control" id="nf-id" type="hidden" name="id" autocomplete="id" value="{{ $result['user']->id }}">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="nf-password">Current Password</label>
                                    <input class="form-control current_password" id="nf-password" type="password" name="current_password" min="1" max="8" autocomplete="current-password">
                                </div>
                                <div class="form-group">
                                    <label for="nf-password">New Password</label>
                                    <input class="form-control new_password" id="nf-password" type="password" name="new_password" min="1" max="8" autocomplete="current-password">
                                </div>
								 <div class="form-group">
                                    <label for="nf-password">Confirm Password</label>
                                    <input class="form-control confirm_password" id="nf-password" type="password" name="confirm_password" min="1" max="8" autocomplete="current-password">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-sm btn-primary update_password"  type="button"> Submit</button>
                        </div>
                </div>
				</form>
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
	 $(".reset_email").click(function(e)
	{		
        e.preventDefault();
        var email = $('.email').val();
		if(email=="")
		{
		alert('Please enter Email id');	
		}
		else
		{
			var formdata = $(".reset_email_form").serialize();
				$.ajax({
				   type:'POST',
				   url:'reset_email',
				   data:formdata,
				   success:function(data)
				   {
					var response = JSON.parse(data);
					if(response.status_code =='200')
					{
						alert(response.message);
						var url ="{{ url('account') }}";
						window.location.href=url;
					}
					else
					{
						alert(response.message);		
					}

				   }

				});	
		}		
		});
		
		
$(".update_password").click(function(e)
	{		
        e.preventDefault();
        var current_password = $('.current_password').val();
        var new_password = $('.new_password').val();
        var confirm_password = $('.confirm_password').val();
		
		if(current_password=="")
		{
		alert('Please enter current password');	
		}
		else if(new_password=="")
		{
		alert('Please enter new password');	
		}
		else if(confirm_password=="")
		{
		alert('Please enter confirm password');	
		}
		else if(confirm_password!=new_password)
		{
		alert('New and confirm password mismatch');	
		}
		else
		{
			var formdata = $(".update_password_form").serialize();
				$.ajax({
				   type:'POST',
				   url:'update_password',
				   data:formdata,
				   success:function(data)
				   {
					var response = JSON.parse(data);
					if(response.status_code =='200')
					{
						alert(response.message);
						var url ="{{ url('account') }}";
						window.location.href=url;
					}
					else
					{
						alert(response.message);		
					}

				   }

				});	
		}		
		});
});
</script>
