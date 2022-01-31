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
.down
{
	float: right;
    text-decoration: none;
    color: #ffffff;
    /* border: 1px solid #3c454c; */
    padding: 3px;
    border-radius: 5px;
    background: #49a4fd;
}
.down:hover
{
float: right;
    text-decoration: none;
    color: #ffffff;
    /* border: 1px solid #3c454c; */
    padding: 3px;
    border-radius: 5px;
    background: #49a4fd;	
}
</style>

  <div class="container account-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
				<div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn header" href="{{ url('account') }}">Account</a>
					<a class="select-btn header" href="{{ url('system') }}">System</a>
					<a class="select-btn header active" href="{{ url('grading') }}">Grading</a>
					<a class="select-btn header" href="{{ url('educationlevel') }}">Education level</a>
				</div>
			
			<div class="col-md-10 col-12 ">
            
				<div class="col-lg-7 col-12 ml-5 mt-5">
				 <form action="" method="post" class="upload_grading_form" id="upload_grading_form" enctype="multipart/form-data">
             {{ csrf_field() }}
					<div class="card">
                    <div class="card-header"><strong>Upload CSV</strong> <a  class="down px-3"  href="template/grading_template.csv">Download Template</a></div>
					
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group" >
                                    <input type="file" name="file" class="form-control" data-parsley-fileextension='csv' id='file' accept=".csv" required>
                                </div>
                                
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-sm btn-primary upload"  type="button"> Submit</button>
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
	var token = $("#token").val();
	$(".upload").click(function(e)
	{		
	/*
	 $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
	  */
		var form = $(".upload_grading_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
      var formData = new FormData($('#upload_grading_form')[0]);
        var file = $('input[type=file]')[0].files[0];
        formData.append('file', file, file.name);
        $.ajax({
            url: "{{ route('gradingupload.post') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',   
            contentType: false,
            processData: false,   
            cache: false,        
            data: formData,
            success: function(data) {
				var response = JSON.parse(data);
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
					
				}
            },
            error: function(data) 
			{
				var response = JSON.parse(data);
                swal({
					title: "",
					text: response.message,
					type: "error"
				   });
            }
        });
		}
				
	});	
	
	
	
	
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
