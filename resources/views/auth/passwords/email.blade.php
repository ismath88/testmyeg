
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
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
							<form action='#' class="reset_password_form" method="post" >
							{{ csrf_field() }}
                            <p class="login-box-msg pt-4 pb-1">Reset Password</p>
					   <p class="text-center">Enter your email address and we will send you a password reset email.</p>
					   
					   <div class="input-group mb-3 login-email">
						 <div class="col-12 px-0">  
						 <label>Email</label>
                         <input type="email" class="form-control email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                               
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
                                            </div>
											
						<div class="row">
					<div class="col-12 mt-5 px-0 pb-4">
                        <div class="col-6 submit-btn mx-auto">
                            <button type="submit" class="btn btn-primary btn-block btn-flat reset_password">
								Reset Password
							</button>
                        </div>
					</div>
					</div>
					<div class="row">
					<div class="col-12 text-center forgot-pwd mx-auto">
                        <p class="pb-4">
                    <a href="{{ url('/login') }}">Login</a>
						</p>
					</div>
				</div>
                          
                        </form>
                    </div>
					
					
					<div class="container">
    <div class="row">
        <a class="btn btn-primary mailpopop" id='mailpopop' data-toggle="modal" href="#ignismyModal">open Popup </a>

        <div class="modal fade" id="ignismyModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>
					
                    <div class="modal-body">
                       
						<div class="thank-you-pop">
							<img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
							<h1>Thank You!</h1>							
							<h3 class="cupon-pop"><span class='message'></span></h3>
							<p>Please Reset Your Password Here</p>
 						</div>
                         
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>
					
					
            </div>
        </div>
    </div>
</div>





@endsection

@section('javascript')

@endsection
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script  src="{{ url('js/parsley.min.js') }}" defer></script>
<script  src="{{ url('js/parsley.js') }}" defer></script>
<script  src="{{ url('js/jquery.min.js') }}"></script>
	<script>
$( document ).ready(function() {
	$('.mailpopop').css('display','none');
	
	
	 $(".reset_password").click(function(e)
	{		
        e.preventDefault();
        var form = $(".reset_password_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			var reset_url ="{{ url('reset_password') }}";
			var formdata = $(".reset_password_form").serialize();
				$.ajax({
				   type:'POST',
				   url:reset_url,
				   data:formdata,
				   success:function(data)
				   {
					  
					var response = JSON.parse(data);
					if(response.status_code =='200')
					{
						
						swal({
							title: "",
							text: response.message,
							type: "success",
							confirmButtonText: "ok"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('password/reset') }}/";
							window.location.href=url;
						   }, 2000);
					}
					else
					{
						swal({
							title: "",
							text: response.message,
							type: "error",
							confirmButtonText: "ok"
						   });		
					}

				   }

				});	
		}		
		});
		
	$("document").on('click','.confirm',function(e)
	{		
	var url ="{{ url('password/reset') }}/";
	window.location.href=url;
	
	});
		
});
</script>

