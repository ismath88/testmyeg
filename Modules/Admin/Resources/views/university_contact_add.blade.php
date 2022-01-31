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
				<form action='#' class="store_universitycontact_form" method="post" data-parsley-validate>
				{{ csrf_field() }}
					<div class="card">
                    <div class="card-header"><strong>Add More Institutes </strong></div>
                        <div class="card-body">
                            <form action="" method="post">
						<div class="form-group">
							<label for="nf-password">Institute Name</label>
							<input type="hidden" value="{{  $result['id'] }}" name="id" >
							<input class="form-control institute_name"  type="text" value="{{ $result['institute_name'] }}" name="institute_name" autocomplete="institute_name" required>
						</div>
						<div class="form-group">
							<label for="nf-password">Country</label>
							
							<select class="form-control country_id" name="country_id" id="country_id" required>
							<option value=''>Select country</option>
							@foreach($result['countries'] as $key=>$value)
							<option value="{{  $value->id }}" {{ $result['country_id'] == $value->id  ? 'selected' : ''}}>{{  $value->country_name }}</option>
							@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="nf-password">City</label>
							<select class="form-control city_id" name="city_id" required>
							<option value=''>Select city</option>
							<?php echo $result['citiesoptions'];  ?>
							</select>
						</div>
						<div class="form-group">
							<label for="nf-password">Contact Person</label>
							<input class="form-control contact_person"  type="text" value="{{ $result['contact_person'] }}" name="contact_person" autocomplete="contact_person" required>
						</div>
						<div class="form-group">
							<label for="nf-password">Contact Number</label>
							<input class="form-control contact_phone"  type="text" value="{{ $result['contact_phone'] }}" name="contact_phone" autocomplete="contact_phone" required>
						</div>
						<div class="form-group">
							<label for="nf-password">Email</label>
							<input class="form-control email_id"  type="email" value="{{ $result['email_id'] }}" name="email_id" autocomplete="email_id" required>
						</div>
						<div class="form-group">
							<label for="nf-password">Address</label>
	<textarea class="form-control address"  type="text"  name="address"  required>{{ $result['address'] }}</textarea>
						</div>
						
					</form>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-sm btn-primary store_universitycontact" type="button"> Submit</button>
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
	var city_id = "{{ $result['city_id'] }}";
	$(".city_id").val(city_id).change();
	 $(".store_universitycontact").click(function(e)	{		
        e.preventDefault();
        var email = $('.email').val();
		var formdata = $(".store_universitycontact_form").serialize();
		var form = $(".store_universitycontact_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			 $('.store_universitycontact').prop('disabled', true);
			var save_url ="{{ url('store_universitycontact') }}";
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
						var url ="{{ url('student/university_contacts') }}";
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
		
$("#country_id").change(function(e)
{
	var country_id = $(this).val();
	
	if(country_id !="")
	{
		var geturl ="{{ url('/student/get_universitycities') }}";
		$.ajax({
		type:'POST',
		url:geturl,
		data:{country_id:country_id},
		success:function(data)
		{
			
			if(data.data.status_code =='200')
			{
			  $('.city_id').find('option').not(':first').remove();	
			  $('.city_id').append(data.data.options);	
			}
			else
			{
			$('.city_id').find('option').not(':first').remove();				
			}

		}

		});	
		
	}
});	
		
		
});
</script>
