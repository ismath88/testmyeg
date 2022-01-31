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
.header
{
	text-decoration:none;
}
</style>
  <div class="container account-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
				<div class="col-md-12 sub-header d-flex col-12">
				    <a class="select-btn header active" href="{{ url('university/performanceapplication') }}">Applications</a>
					<a class="select-btn header" href="{{ url('university/performancestudent') }}">Student Enrollment</a>
					<a class="select-btn header">Sales and Commissions</a>
				</div>
			
			<div class="col-md-10 col-12 ">
            <div class="col-lg-9 col-lg-7 col-12 ml-5 mt-5">
			
				</div>
				
            </div>
            <!-- END -->
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
<script  src="{{ url('js/parsley.min.js') }}" defer></script>
<script  src="{{ url('js/parsley.js') }}" defer></script>
<script  src="{{ url('js/jquery.min.js') }}"></script>
	<script>
$( document ).ready(function() {
	$('.error_cur,.error_new,.error_confirm,.invalid_password').css('display','none');
	$(".reset_email").click(function(e)
	{		
        e.preventDefault();
        var email = $('.email').val();
		var form = $(".reset_email_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{

			var validRegExpemailid=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if(email.search(validRegExpemailid)== -1)
			{				 
				return false;
			}
			else if(email.charAt(0) == "." || email.charAt(0) == "_" || email.charAt(0) == "-")
			{
				return false;
			}
			else if((email.length) < 6)
			{
				return false;
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
							swal({
							title: "",
							text: response.message,
							type: "success"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('account') }}";
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
							var url ="{{ url('account') }}";
							window.location.href=url;
						   }, 2000);		
						}

					}

					});	
			}
			
		}
				
	});
		
		
	$(".update_password").click(function(e)
	{		
	$('.error_cur,.error_new,.error_confirm,.invalid_password').css('display','none');
        e.preventDefault();
        var current_password = $('.current_password').val();
        var new_password = $('.new_password').val();
        var confirm_password = $('.confirm_password').val();
		var subject = /^0+$/;
		
		
		
		var form = $(".update_password_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
		if(current_password.match(subject)) 
		{
			$('.error_cur').css('display','block');
			return false;
		}
		if(new_password.match(subject)) 
		{
			$('.error_new').css('display','block');
			return false;
		}
		if(current_password.match(subject)) 
		{
			$('.error_confirm').css('display','block');
			return false;
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
						swal({
							title: "",
							text: response.message,
							type: "success"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('account') }}";
							//var url ="/logout";
							window.location.href=url;
						   }, 2000);
					}
					else
					{
						$('.invalid_password').css('display','block')		
					}

				   }

				});	
		}
		}		
		});
});
</script>
