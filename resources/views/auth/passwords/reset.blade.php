@extends('layouts.authApp')

@section('pageTitle', 'Reset Password')

@section('content')
<div class="container-fluid login-page">
    <div class="row justify-content-center">
	  <div class="login-box">
	   <div class="login-logo mb-4">
              <a href="{{ url('/login') }}"><img src="../img/formee_logo_dark.svg" alt="" class=""></a>
       </div>
        <div class="card">
                <div class="card-body login-card-body">
					<form method="post" action="{{ url('/password/email') }}" class="update_password_form">
                            @csrf
						<p class="login-box-msg pt-4 pb-1">Reset Password </p>
                       <!-- <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" 
                            value="{{ $email ?? old('email') }}" placeholder="Email">
                            @error ('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> -->
						<div class="input-group mb-3 login-password">
						 <div class="col-12 px-0">  
						 <label>New Password</label> 
                        <input type="password" class="form-control @error('password') is-invalid @enderror new_password" name="password">
                        <input type="hidden" class="form-control @error('password') is-invalid @enderror" name="id" value="{{ $result->id }}">
                            @error ('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
					
					<div class="input-group mb-3 login-password">
						 <div class="col-12 px-0">  
						 <label>Re-enter New Password</label> 
                        <input type="password" name="password_confirmation " class="form-control confirm_password">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                               </span>
                            @endif
                        </div>
                    </div>
                        
						
						<div class="row">
						<div class="mt-5 col-12 mx-0 row pb-4">
                        <div class="col-6 submit-btn mx-auto">
							<button class="btn btn-primary btn-block btn-flat" type="submit">Cancel</button>
                        </div>
						<div class="col-6 submit-btn mx-auto">
							<button class="btn btn-primary save-btn btn-block btn-flat update_password" type="button">Save</button>
                        </div>
						</div>
                    </div>
					
                     
                      <!--  <button type="submit" class="btn btn-block btn-primary btn-block btn-flat">
                            <i class="fa fa-btn fa-refresh"></i> Reset
                        </button> -->
                    </form>
                </div>
        </div>
		</div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
<script src="../js/jquery.min.js"></script>
	<script>
$( document ).ready(function() {
	
		
		
		$(".update_password").click(function(e)
	{		
        e.preventDefault();
        var new_password = $('.new_password').val();
        var confirm_password = $('.confirm_password').val();
		if(new_password=="")
		{
		alert('Please enter new password');	
		$('.new_password').focus();
		}
		else if(confirm_password=="")
		{
		alert('Please enter confirm password');	
		$('.confirm_password').focus();
		}
		else if(confirm_password!=new_password)
		{
		alert('New and confirm password mismatch');	
		}
		else
		{
			var recoverurl = "{{ url('recover_password') }}";
			var formdata = $(".update_password_form").serialize();
				$.ajax({
				   type:'POST',
				   url:recoverurl,
				   data:formdata,
				   success:function(data)
				   {
					var response = JSON.parse(data);
					if(response.status_code =='200')
					{
						alert(response.message);
						var url ="{{ url('recover') }}/"+response.user.id;
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
