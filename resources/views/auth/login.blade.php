@extends('layouts.authApp')

@section('pageTitle', 'Login')

@section('content')
<style>
.parsley-required
{
	color:red;
}
.required
{
	color:red;
}
</style>
    <div class="container-fluid login-page">
      <div class="row justify-content-center">
	  <div class="login-box">
	   <div class="login-logo mb-4">
            <a href={{ url('login') }}><img src="img/formee_logo_dark.svg" alt="" class=""></a>
       </div>
	   <div class="card">
	    <p class="login-box-msg pt-4 pb-1">Welcome to Formee Express</p>
        <div class="card-body login-card-body">
                <form method="POST" action="{{ url('login_check') }}" class="login_form">
                    @csrf
                    <div class="input-group mb-3 login-email">
						 <div class="col-12 px-0">  
						 <label>Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
						</div>
                        
                    </div>
					
					<div class="input-group mb-3 login-password">
						 <div class="col-12 px-0">  
						 <label>Password</label> 
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                    @error ('password')
                        <span class="invalid-feedback">
                            <strong>{{ $emessage }}</strong>
                        </span>
                    @enderror
                        </div>
                    </div>
					<div class="row">
					
										 <div class="col-12  mb-5 forgot-pwd">
                    <p class="mb-1">
						<a href="{{ route('password.request') }}" class="btn btn-link px-0">{{ __('I forgot my password') }}</a>
                    </p>
					</div>
					</div>
					
					<div class="row">
						<div class="col-12 pb-4">
                        <div class="col-6 submit-btn mx-auto">
							<button class="btn btn-primary btn-block btn-flat login" type="button" >{{ __('Sign In') }}</button>
                        </div>
						</div>
                    </div>
                  
                   
            <!--<div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  @if (Route::has('password.request'))
                    <a href="{{ route('register') }}" class="btn btn-primary active mt-3">{{ __('Register') }}</a>
                  @endif
                </div>
              </div>
            </div>-->
        </div>
		</div>
		
		
		
		</div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection
<!-- Optional theme -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script  src="js/parsley.min.js" defer></script>
<script  src="js/parsley.js" defer></script>
<script  src="js/jquery.min.js"></script>
	<script>
$( document ).ready(function() {
	
	 $(".login").click(function(e)	{		
        e.preventDefault();
        var email = $('.email').val();
		var formdata = $(".login_form").serialize();
		var form = $(".login_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			var save_url ="{{ url('login_check') }}";
			
				$.ajax({
				   type:'POST',
				   url:save_url,
				   data:formdata,
				   success:function(data)
				   {
					var response = JSON.parse(data);
					if(response.status_code =='200')
					{
						var url ="{{ url('home') }}";
						window.location.href=url;
						/*
						swal({
							title: "",
							text: response.message,
							type: "success"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('home') }}";
							window.location.href=url;
						   }, 2000);
						   */
					}
					else
					{
						//alert(response.message);
						
						swal({
							title: "",
							text: response.message,
							type: "error"
						   });					   
					}

				   }

				});	
		}
				
		});
		
		
});
</script>