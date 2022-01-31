@extends('layouts.app')

@section('content')
 <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .thank-you-pop{
	width:100%;
 	padding:20px;
	text-align:center;
}
.thank-you-pop img{
	width:76px;
	height:auto;
	margin:0 auto;
	display:block;
	margin-bottom:25px;
}

.thank-you-pop h1{
	font-size: 42px;
    margin-bottom: 25px;
	color:#5C5C5C;
}
.thank-you-pop p{
	font-size: 20px;
    margin-bottom: 27px;
 	color:#5C5C5C;
}
.thank-you-pop h3.cupon-pop{
	font-size: 25px;
    margin-bottom: 40px;
	color:#222;
	display:inline-block;
	text-align:center;
	padding:10px 20px;
	border:2px dashed #222;
	clear:both;
	font-weight:normal;
}
.thank-you-pop h3.cupon-pop span{
	color:#03A9F4;
}
.thank-you-pop a{
	display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8BC34A;
    border-radius: 17px;
}
.thank-you-pop a i{
	margin-right:5px;
	color:#fff;
}
#ignismyModal .modal-header{
    border:0px;
}
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
.required,.error_new,.error_confirm,.error_cur,#errmsg,#errmsg_bsb
{
	color:red;
}
.invalid_password,.already
{
	color:red;
}
.header
{
text-decoration:none;	
}
        </style>
  <div class="container system-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
            <div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn header" href="{{ url('account') }}">Account</a>
					<a class="select-btn header active" href="{{ url('system') }}">System</a>
					<a class="select-btn header" href="{{ url('grading') }}">Grading</a>
					<a class="select-btn header" href="{{ url('educationlevel') }}">Education level</a>
				</div>
			
			<div class="col-md-10 col-12 ">
            <div class="col-lg-7 col-12 ml-5 mt-5">
			<fieldset >
				<div class="row mb-2">
					<div class="col-7">
						Gold User Limit
                    </div>
					<div class="col-5">						
						<a data-toggle="modal" style="text-decoration:none" href="#ignismyModal">{{ $result['system']->gold_user_limit }} </a>
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						platinum User Limit
                    </div>
					<div class="col-5">
						<a data-toggle="modal" style="text-decoration:none" href="#platinum_user_limitpop">{{ $result['system']->platinum_user_limit }} </a>
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						Top Agent Limit
                    </div>
					<div class="col-5">
						<a  data-toggle="modal" style="text-decoration:none" href="#topagent_pop">{{ $result['system']->topagent_limit }} </a>
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						Top Agent Limit Time Days
                    </div>
					<div class="col-5">
						<a  data-toggle="modal" style="text-decoration:none" href="#limitdays_pop">{{ $result['system']->topagent_limit_days }} </a>
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						Agent Commission %
                    </div>
					<div class="col-5">
						<a  data-toggle="modal" style="text-decoration:none" href="#commission_pop">{{ $result['system']->agent_commission }} </a>
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						University Commission %
                    </div>
					<div class="col-5">
						<a  data-toggle="modal" style="text-decoration:none" href="#univ_commission_pop">{{ $result['system']->university_commission }} </a>
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						GST %
                    </div>
					<div class="col-5">
						<a  data-toggle="modal" style="text-decoration:none" href="#gst_pop">{{ $result['system']->gst }} </a>
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						Cut off Date for Invoice Days
                    </div>
					<div class="col-5">
						<a  data-toggle="modal" style="text-decoration:none" href="#cutoff_pop">{{ $result['system']->cutoff_date_invoice }} </a>
                    </div>
                </div>
				</fieldset>
				</div>
				<!--a  data-toggle="modal" style="text-decoration:none" class="confirmpop" href="#confirmpop">click </a-->
				
		<div class="modal fade" id="confirmpop" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Do you want Save?</strong></div>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='gold_user_limit'  data-form='gold_form' type="button">yes </button>
							<button class="btn btn-sm btn-primary update_setting" id='gold_user_limit'  data-form='gold_form' type="button">No </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
        </div>
				
				
				
				
				 <!--a class="btn btn-primary mailpopop" data-toggle="modal" href="#ignismyModal">s </a-->

        <div class="modal fade" id="ignismyModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin system setting</strong></div>
							<form action='#' class="gold_form" method="post" >
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>Gold user limit</label>
							<input class="form-control gold_user_limit" id="inputfield" type="text" data-parsley-trigger="keyup"   data-parsley-type="digits"  name="gold_user_limit" required  autocomplete="off">
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='gold_user_limit'  data-form='gold_form' type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
        </div>
		
		
		<div class="modal fade" id="platinum_user_limitpop" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin system setting</strong></div>
							<form action='#' class="platinum_form" method="post" >
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>Platinum user limit</label>
							<input class="form-control platinum_user_limit" id="inputfield" type="text" data-parsley-trigger="keyup"   data-parsley-type="digits"  name="platinum_user_limit" required  autocomplete="off">
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='platinum_user_limit' data-form='platinum_form'  type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
        </div>
				
				
			<div class="modal fade" id="topagent_pop" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin system setting</strong></div>
							<form action='#' class="topagent_limit_form" method="post" >
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>Topagent Limit</label>
							<input class="form-control topagent_limit" id="inputfield" type="text" min="0" max="20000" step="100" 
    data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
    data-parsley-type="number"  name="topagent_limit" required  autocomplete="off">
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='topagent_limit' data-form='topagent_limit_form'  type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
        </div>
		
		
		<div class="modal fade" id="limitdays_pop" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin system setting</strong></div>
							<form action='#' class="limitdays_form" method="post" >
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>Top Agent Limit Time Days</label>
							<input class="form-control topagent_limit_days" id="inputfield" type="text" data-parsley-trigger="keyup"   data-parsley-type="digits"  name="topagent_limit_days" required  autocomplete="off">
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='topagent_limit_days' data-form='limitdays_form'  type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
        </div>
			

		<div class="modal fade" id="commission_pop" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin system setting</strong></div>
							<form action='#' class="commission_form" method="post" >
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>Agent Commission %</label>
							<input class="form-control agent_commission" id="inputfield" type="text" min="0" max="20000" step="100" 
    data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
    data-parsley-type="number"  name="agent_commission" required  autocomplete="off">
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='agent_commission' data-form='commission_form'  type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
        </div>


		<div class="modal fade" id="univ_commission_pop" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin system setting</strong></div>
							<form action='#' class="univ_commission_form" method="post" >
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>University Commission %</label>
							<input class="form-control university_commission" id="inputfield" type="text" min="0" max="20000" step="100" 
    data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
    data-parsley-type="number"  name="university_commission" required  autocomplete="off">
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='university_commission' data-form='univ_commission_form'  type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
        </div>
				
				
		<div class="modal fade" id="gst_pop" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin system setting</strong></div>
							<form action='#' class="gst_form" method="post" >
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>Gst</label>
							<input class="form-control gst" id="inputfield" type="text" min="0" max="20000" step="100" 
    data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
    data-parsley-type="number"  name="gst" required  autocomplete="off">
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='gst' data-form='gst_form'  type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
        </div>
		
		
		<div class="modal fade" id="cutoff_pop" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin system setting</strong></div>
							<form action='#' class="cufoff_form" method="post" >
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>Cut off Date for Invoice Days</label>
							<input class="form-control cutoff_date_invoice" id="inputfield" type="text" data-parsley-trigger="keyup"   data-parsley-type="digits"  name="cutoff_date_invoice" required  autocomplete="off">
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary update_setting" id='cutoff_date_invoice' data-form='cufoff_form'  type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
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

<script  src="js/parsley.min.js" defer ></script>
<script  src="js/parsley.js" defer></script>
<script  src="js/jquery.min.js"></script>
	<script>
$( document ).ready(function() {


$(".update_setting").click(function(e)	
	 {
		 var form_name = $(this).attr('data-form')
		 var form = $("."+form_name);
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			var id=1;
		var field=$(this).attr('id');
		var field_value=$('.'+field).val();
		//if (confirm("Are you sure want to save?")) {
		swal({
        title: "",
        text: "Do you want to continue?",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) 
		{
		var save_url ="{{ url('update_setting') }}";			
				$.ajax({
				   type:'POST',
				   url:save_url,
				   data:{id:id,field:field,field_value,field_value},
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
						var url ="{{ url('system') }}";
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
						var url ="{{ url('manage_invites') }}";
						window.location.href=url;
						}, 2000);		
					}

				   }

				});
				}
		else 
		{
          swal("Cancelled", "", "error");
        }
      });
		
		//}
		}
		return false;	 
	 });






















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
