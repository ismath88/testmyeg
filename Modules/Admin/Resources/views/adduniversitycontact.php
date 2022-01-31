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
.parsley-type
{
	color:red;
}
</style>
  <div class="container grading-page">
        <div class="fade-in">
             <div class="row">
			
            <div class="col-md-7 col-12 ml-5 mt-5">
				<form action='#' class="store_invites_form" method="post" data-parsley-validate>
				{{ csrf_field() }}
					<div class="card">
                    <div class="card-header"><strong>Add Invite Admin Users </strong></div>
                        <div class="card-body">
                            <form action="" method="post">
								<div class="form-group">
                                    <label for="nf-password">Name <span class="required">*</span></label>
                                    <input class="form-control name" id="nf-title" type="text" name="name" autocomplete="name" required>
                                </div>
								<div class="form-group">
                                    <label for="nf-password">Email  <span class="required">*</span></label>
                                    <input class="form-control email" id="nf-title" type="email" name="email" autocomplete="email" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="nf-password">Account Type <span class="required">*</span></label>
									<select class="form-control account_type" name="account_type" required>
									<option value=''>Select group</option>
									@foreach($result['account_type'] as $key=>$value)
									<option value="{{  $value->id }}">{{  $value->usergroup_name }}</option>
						            @endforeach
									</select>
                                </div>
								 <div class="form-group">
                                    <label for="nf-password">Message <span class="required">*</span> </label>
                                    <input class="form-control message" id="nf-title" type="text" name="message" autocomplete="message" required>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
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
<!-- Optional theme -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">  

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script  src="{{ url('js/parsley.min.js') }}" defer></script>
<script  src="{{ url('js/parsley.js') }}" defer></script>
<script  src="{{ url('js/jquery.min.js') }}"></script>
<script type="text/javascript" charset="utf8"  src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
	<script>
$( document ).ready(function() {
	
	 $(".store_invites").click(function(e)	{		
        e.preventDefault();
        var email = $('.email').val();
		var formdata = $(".store_invites_form").serialize();
		var form = $(".store_invites_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			 $('.store_invites').prop('disabled', true);
			var save_url ="{{ url('admin/store_invites') }}";
			
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
						var url ="{{ url('manage_invites') }}";
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
						 $('.store_invites').prop('disabled', false);
					}

				   }

				});	
		}
				
		});
		
		
});
</script>
