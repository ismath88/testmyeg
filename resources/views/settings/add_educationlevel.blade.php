@extends('layouts.app')

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
  <div class="container add-education-page">
        <div class="fade-in">
             <div class="row">
			<div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn header" href="{{ url('account') }}">Account</a>
					<a class="select-btn header" href="{{ url('system') }}">System</a>
					<a class="select-btn header" href="{{ url('grading') }}">Grading</a>
					<a class="select-btn header active" href="{{ url('educationlevel') }}">Education level</a>
				</div>
            <div class="col-md-11 col-12 ">
            <div class="col-md-10 col-12 row ml-5 mt-5">
				<div class="col-md-6 col-12">
				<form action='#' class="store_educationlevel_form" method="post" >
				{{ csrf_field() }}
					<div class="">
                   
                        <div class="card-body">
                            <form action="" method="post">
								<div class="form-group">
                                    <label for="nf-password">Main Level</label>
									<select class="form-control mainlevel_id" name="mainlevel_id" required>
									<option value=''>Select Main level</option>
									@foreach($result['mainlevel'] as $key=>$value)
									<option value="{{  $value->id }}">{{  $value->level_name }}</option>
						            @endforeach
									</select>
                                </div>
								<div class="form-group">
                                    <label for="nf-password">Country</label>
									<select class="form-control country_id" name="country_id" required>
									<option value=''>Select country</option>
									@foreach($result['country'] as $key=>$value)
									<option value="{{  $value->id }}">{{  $value->country_name }}</option>
						            @endforeach
									</select>
                                </div>
                                <div class="form-group">
                                    <label for="nf-password">Title</label>
                                    <input class="form-control educationlevel_name" id="nf-title" type="text" name="educationlevel_name" autocomplete="educationlevel_name" required>
                                </div>
								<!-- <div class="form-group">
                                    <label for="nf-password">Status</label>
                                    <label class="switch">
									  <input type="checkbox" checked name='status'>
									  <span class="slider round"></span>
									</label>
                                </div> -->
                            </form>
                        </div>
                       
						<div class="col-12 ml-2 mb-3">
					<div class="form-group">
                                    <label for="nf-password">Status</label>
                                    <label class="switch">
									  <input style="height:auto !important;" type="checkbox" checked name='status'>
									  <span class="slider round"></span>
									</label>
                                </div> 
                </div>
				<div class="col-12 text-right pr-0 mb-3">
					<button class="btn btn-sm btn-primary store_educationlevel" type="button"> Submit</button>
				</div>
                </div>
				</form>
				</div>
				
				<div class="col-lg-6 mt-4 col-12"  style="display:none">
				<div class="col-12">
					<div>Grade: HD-N </div>
					<div> victoria Grade: A-F </div>
                </div>
				<div class="col-12 mt-5">
					<button class="btn btn-sm btn-primary reset_email" type="button"> Add Subsection</button>
				</div>
				</div>
				
				
				</div></div>
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
<script  src="js/parsley.min.js" defer></script>
<script  src="js/parsley.js" defer></script>
<script  src="js/jquery.min.js"></script>
	<script>
$( document ).ready(function() {
	
	 $(".store_educationlevel").click(function(e)	{		
        e.preventDefault();
        var email = $('.email').val();
		var form =$(".store_educationlevel_form");
		var formdata = $(".login_form").serialize();
		var form = $(".store_educationlevel_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			var save_url ="{{ url('store_educationlevel') }}";
			var formdata = $(".store_educationlevel_form").serialize();
				$.ajax({
				   type:'POST',
				   url:save_url,
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
				
		});
		
		
});
</script>
