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
.sub_users
{
	max-height: 140px;
    overflow-x: auto;
}
.pageloader {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('img/loading.gif') 50% 50% no-repeat rgb(249, 249, 249);
  opacity: .8;
}
.action_btn
{
	padding: 7px 13px;
}
td.highlight > a {
	background: #d2cfcf!important;
	color: #fff!important;
}
.cancel_msg
{
color:red;
}
</style>
<div class="pageloader"></div>
  <div class="container account-page">
        <div class="fade-in">
             <div class="row">
			 
			 <a data-toggle="modal" data-target="#meetingModal"></a>

			 <div class="modal fade" id="meetingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">	
			<div class="modal-dialog modal-dialog-centered" role="document">	
				<div class="modal-content">	
				<div class="modal-header">	
					<h5 class="modal-title" id="exampleModalCenterTitle">Meeting Details </h5>	
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">	
					<span aria-hidden="true">&times;</span>	
					</button>	
				</div>	
				<form action='#' class="create_meeting_form col-12" method="post" >
				<input class="form-control id" id="meeting_id" type="hidden" name="id" value=" ">
				{{ csrf_field() }}
				<div class="modal-body">	
					<!-- working area -->	
					<div class="col-md-12 col-12 px-0 mt-4">
				<div class=""> 
					<span class="cancel_msg"></span>
					<div class="row col-md-12">
					<div class="col-md-4 acceptmeeting">
					<button type="button" class=" btn btn-primary accept_meeting action_btn" id="accept_meeting" data-reason="Accepted" data-status="0">Accept Meeting</button>
					</div>
					<div class="col-md-4 reshedule_meeting">
					<button type="button" class=" btn btn-primary reshedule_meeting action_btn" id="reshedule_meeting">Reshedule Meeting</button>
					</div>
					<div class="col-md-4 cancelmeeting">
					<button type="button" class=" btn btn-danger cancel_meeting action_btn" id="accept_meeting" data-reason="Rejected" data-status="1">Cancel Meeting</button>
					</div>
					</div>

					<div class="pl-0 col-12 my-3">
					<div class="col-11 pl-0">
					<label class="label-title">Tell us What you need</label><br>
					<textarea type="text" name="description" placeholder="Type here" disabled readonly class="col-11 text-border description fields" rows="5" required="required"></textarea>
					
					</div>
					
					
					<div  class="col-10 row pb-4  pl-0 pt-3">
					<label class="label-title col-12">Estimated time for Meeting</label><br>
					<div class="col-6">
					<label class="sub-title">Date</label><br>
					<input type="text" value="" disabled readonly id="meeting_date" name="meeting_date"  class="form-control meeting_date fields"  />
					</div>
					
					<div class="col-6">
					<label class="sub-title">Time</label><br>
					<input type="text" value="" id="meeting_time" disabled readonly name="meeting_time"  class="form-control meeting_time fields"  />
					</select>
					</textarea>
					</div>
					</div>

					</div>
					</div>
					</form>
					</div>	
					
					<!-- working area -->	
				</div>	
				</div>	
			</div>	
			</div>	
			<!-- Modal -->
			<div class="modal fade" id="zoomconfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered zoom-popup" role="document">
  <form action='#' class="zoom_credential_form" method="post" >
				{{ csrf_field() }}
    <div class="modal-content p-16px">
      <div class="modal-header border-transparent p-0">
        
      </div>
      <div class="modal-body">
	  <div class="form-group">
			<h2>Zoom Configuration</h2>
			<input type="hidden" name="type" class="form-control type" id="appId" value="Admin">
			<input type="hidden" name="type_id" class="form-control type_id" id="appId" value="{{ $result['user_id'] }}">
			<label class="font-14">Client ID:</label>
			<input type="text" name="client_id" class="form-control client_id" id="appId" value="" required>
			<span class="client_id_error" style="color:red">This value is required</span>
			<label class="font-14">Client Secret:</label>
			<input type="text" name="client_secret" class="form-control client_secret" id="secretId" value="" required>
			<span class="client_secret_error" style="color:red">This value is required</span></div>
      </div>
      <div class="modal-footer">
        
		<button type="button" class="font-14 zoom-conf-btn btn btn-secondary" data-dismiss="modal">Cancel</button>
		<button type="button" class="font-14 zoom-conf-btn btn btn-secondary save_zoom_credentials">Save</button>
		<button type="button" class="font-14 zoom-conf-btn btn btn-secondary zoom_authorise">Authorise</button>
      </div>
    </div>
	</form>
  </div>
</div>


            <!-- START -->
			<div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
				<div class="uni-left-card border-transparent card">
				<div class="heading-calendar mt-3 mb-1 d-flex col-12">
				<h5 class="mb-0 app-sub-heading font-26 font-weight-bold col-6 px-0">calendar</h5>
				</div>
				<div class="px-0 pt-4 card-body pb-0">
				<div class="col-md-12 left-dash-align">
				<div id="datepicker" data-date="12-02-2012" data-date-format="dd-mm-yyyy"></div>
				<hr>
				<h5 class="app-sub-heading font-14px mb-3 font-weight-bold">TEAM MEMBERS</h5>

				<ul class="pl-1 dash-team-list sub_users">
				@foreach($result['sub_users'] as $key=>$value)
				<li class="red-dot px-3"> {{ $value->email }}</li>
				@endforeach
				</ul><div class="col-12 px-0"><button class="edit- btn btn-primary blue-otln-ntn mr-2 get_zoom_credential">+ Link Account</button></div>
				<hr>
				<h5 class="mb-4 app-sub-heading font-14px mb-3 font-weight-bold">TEAM STATISTICS</h5>
				<div class="row col-12 px-0 mx-0"> 
				<div class="total-app active pb-2  p-3  card col-5 mr-3 trans-border event-box-shadow">
				<h5 class="font-12 font-weight-bold mb-0">Video Meetings</h5>
				<div class="w-100 mx-auto my-0 px-0 ">
				<span class="blue-text font-24 height-null">{{ $result['meetingcount'] }}</span>
				<span class="height-null align-middle pl-2 font-10">this month</span>
				</div>
				</div>
				<div class="total-app active pb-2  p-3 card col-5 mr-3 trans-border event-box-shadow">
				<h5 class="font-12 font-weight-bold mb-0">Application Sent</h5>
				<div class="w-100 mx-auto my-0 px-0">
				<span class="blue-text font-24 height-null">{{ $result['application_sent'] }}</span>
				<span class="height-null align-middle pl-2 font-10">this month</span>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>


				<!--2ND ROW-->
				<div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
				<div class="uni-left-card border-remove-right card mb-0 ">
				<div class="col-12 row">
				<div class="heading-calendar mt-3 d-flex col-6">
				<h5 class="mb-0 app-sub-heading font-26 font-weight-bold col-5 px-0">Meetings</h5> 
				<a href="{{ url('createevent') }}"><button class=" edit- btn btn-primary font-weight-bold font-12 blue-btn">+ Create new</button></a>
				</div>
				<div class="accordion feedback-acc col-6 px-0" id="faq">
				<div class="grey-color p-1 mt-3 box-shadow-dash">
					<button class="edit- btn background-transparent selected" data-target="#faq1" aria-expanded="true" aria-controls="faq1" data-toggle="collapse" >Day</button>
					<button class="edit- btn background-transparent" data-target="#faq2" aria-expanded="false" aria-controls="faq2" data-toggle="collapse">Week</button>
					<button class="edit- btn background-transparent"data-target="#faq3" aria-expanded="false" aria-controls="faq3" data-toggle="collapse">Month</button>
					</div>
					</div>
					</div>

					<div class="col-12">
							<!--3rd row-->
					<div class="px-0 pt-3 card-body">
					<div class="col-md-12 left-dash-align px-0 scroll-event">
					<div class="accordion feedback-acc horizon-event" id="faq">
					<div class="day-tab d-flex">
					<!--**Tab-content-1**-->
					<div  id="faq1" class="card collapse show width-320px" aria-labelledby="faqhead1" data-parent="#faq">
					<div class="pt-3 card-body white-container">
					<div class="dashboard-border col-3-dash">
					<span class="text-nowrap">
					<span>{{ date('Y-m-d') }}</span>
					</div>

					<div class="cal_meeting"></div>

					</div>
					</div>
					<!--**Tab-content-2**-->
					



					<div  id="faq2" aria-labelledby="faqhead2" data-parent="#faq" class="card collapse width-320px">
					<div class="weekly_meeting">
					<div class="pt-3 card-body white-container">
					<!-- <div class="col-12">TAB-2</div> -->
								
					</div>
					</div>




					<!--**Tab-content-2**-->
					<div  id="faq3" aria-labelledby="faqhead3" data-parent="#faq" class="card collapse width-320px">
					<div class="pt-3 card-body white-container">
					<!-- <div class="col-12">TAB-3</div> -->
					<div class="dashboard-border col-3-dash">
					<span class="text-nowrap">
					<!-- <span>02</span> nd Saturday</span> -->
					</div>

					<div class="monthly_meeting">
					
					</div>


					</div>
					</div>

					</div>
					</div>
					</div>
            <!-- END -->
            </div>
					</div>

				

				<!--<div class="px-0 pt-4 card-body">
				<div class="col-md-12 left-dash-align">
				<div>
				<div class="card white-container">
				<div class="pt-3 card-body">
				<div class="dashboard-border"><span><span class='cal_today'>{{ date('Y-m-d') }}</span></div>


				<div class="cal_meeting1">


				</div>
				

				</div>
				</div>
				</div>
				</div>
				</div>-->



				</div>
				</div>

					<!--replaced tab content design-->>
					<!--3rd row-->
					
        </div>
    </div>
	
</div>
@endsection
<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'rel='stylesheet'>       


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script  src="{{ url('js/parsley.min.js') }}" defer></script>
<script  src="{{ url('js/parsley.js') }}" defer></script>
<script  src="{{ url('js/jquery.min.js') }}"></script>
<link href= 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
      
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
	<script>
$( document ).ready(function() {
	$(".pageloader").hide();
	$('.error_cur,.error_new,.error_confirm,.invalid_password').css('display','none');
	$.noConflict();	
	//$( "#datepicker" ).datepicker();
	$('.client_id_error').css('display','none');	
	$('.client_secret_error').css('display','none');
	var auth_msg = "{{ $result['auth_msg'] }}";
	if(auth_msg !="")
	{
	swal({
	title: "",
	text: auth_msg,
	type: "success"
	});
	}
	$(".zoom_authorise").click(function(e)
	{
		e.preventDefault();
		var form = $(".zoom_credential_form");
		var type = $('.type').val();
		var type_id = $('.type_id').val();		
		var client_id = $('.client_id').val();
		var client_secret = $('.client_secret').val();
		var count = 0;
		$('.client_id_error').css('display','none');	
		$('.client_secret_error').css('display','none');	
		if(client_id == "")
		{
			count++;
			$('.client_id_error').css('display','block')	
		}
		if(client_secret == "")
		{
			count++;
			$('.client_secret_error').css('display','block')	
		}
		if(count <= 0)
		{
			var url ='';
			//var zoom_url = 'http://localhost:8000/zoom/callback.php';
			var zoom_url = "{{ Config::get('siteVars.zoom_url') }}";
			//var redirect_url = 'https://formeeadmin.bicsglobal.com/zoom/callback.php';
			//var redirect_url = 'http://admin.formeeexpress.com/zoom/callback.php';
			var param = btoa(type_id+','+type+','+client_id+','+client_secret);
			var url = "https://zoom.us/oauth/authorize?response_type=code&client_id="+client_id+"&state="+param+"&redirect_uri="+zoom_url;
			window.location.href = url;
		
		}
	});
	$(".save_zoom_credentials").click(function(e)
	{		
        e.preventDefault();
		var form = $(".zoom_credential_form");
		var type = $('.type').val();
		var type_id = $('.type_id').val();		
		var client_id = $('.client_id').val();
		var client_secret = $('.client_secret').val();
		var count = 0;
		$('.client_id_error').css('display','none');	
		$('.client_secret_error').css('display','none');	
		if(client_id == "")
		{
			count++;
			$('.client_id_error').css('display','block')	
		}
		if(client_secret == "")
		{
			count++;
			$('.client_secret_error').css('display','block')	
		}
		//form.parsley().validate();
		//if(form.parsley().isValid()){
			if(count <= 0){
				var formdata = $(".zoom_credential_form").serialize();
					$.ajax({
					type:'POST',
					url:"{{ url('save_zoom_credentials') }}",
					data:{client_id:client_id,client_secret:client_secret,type:type,type_id:type_id},
					success:function(data)
					{
						var response = (data);
						if(response.status_code =='200')
						{
							swal({
							title: "",
							text: response.message,
							type: "success"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('createmeeting') }}";
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

					}

					});	
			
		}
				
	})
	$(document).on('click','.get_zoom_credential',function()
	{
		
		var type = $('.type').val();	
		var type_id = $('.type_id').val();	
		$.ajax({
		type:'GET',
		url:"{{ url('get_zoom_credentials') }}/"+type+'/'+type_id,
		success:function(data)
		{
			var response = (data);
			if(response.status_code =='200')
			{
				$('#zoomconfig').modal('show');
				$('.client_id').val(response.result.clientid);
				$('.client_secret').val(response.result.clientsecret);
			}
			else
			{						
				$('#zoomconfig').modal('show');	
				$('.client_id').val('');
				$('.client_secret').val('');	
			}
		}

		});	
      
	})

	var dates = ['03/02/2017', '10/22/2020', '10/10/2020'];
	var storedFiles = [];

		var geturl ="{{ url('getallmeetings') }}";
		$.ajax({
		type:'GET',
		url:geturl,
		//  data:{meeting_date:meeting_date},
		success:function(data)
		{
			//var response = JSON.parse(data);
			
			if(data.status_code =='200')
			{
			 $('.cal_meeting').html('');
			 $('.cal_meeting1').html('');
			 $('.weekly_meeting').html('');
			 $('.monthly_meeting').html('');
			 $('.cal_meeting').append(data.today_meeting);
			 $('.cal_meeting1').append(data.today_meeting);
			 $('.weekly_meeting').append(data.weekly_meeting);
			 $('.monthly_meeting').append(data.monthly_meeting);
			 //console.log(data.meetingDates);	
			// storedFiles = data.meetingDates;	
			//console.log(storedFiles);
			 var meetfiles = (data.meetingDates).split(',');
				for (i = 0; i < meetfiles.length; i++) 
				{
				storedFiles.push(meetfiles[i]);	  
				}

				



				$('#datepicker').datepicker({
        // inline: true,
        // firstDay: 1,
        // changeMonth: false,
        // changeYear: true,
        // showOtherMonths: true,
        // showMonthAfterYear: false,
        // yearRange: "2015:2025",      
        // dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		dateFormat: "yy-mm-dd",
        onSelect: function (date) {
			$('.cal_today').text(date)
            var meeting_date =date;	
		var geturl ="{{ url('get_meetings') }}/"+meeting_date;
		$.ajax({
		type:'GET',
		url:geturl,
		//  data:{meeting_date:meeting_date},
		success:function(data)
		{
			//var response = JSON.parse(data);
			if(data.status_code =='200')
			{
			 $('.cal_meeting').html('');
			 $('.cal_meeting').append(data.meetings);
			/*
			 $('.cal_meeting1').html('');
			 $('.cal_meeting1').append(data.meetings);
			 */
			  
			}
			else
			{
						
			}
		}

		});	
		},
		beforeShowDay: highlightDays
	});






			}
			else
			{
						
			}
			

		}

		});	



		




//var dates = ['03/02/2017', '10/22/2020', '10/10/2020'];
	
	                 
	function highlightDays(date) 
	{
		//console.log('allfiles--'+storedFiles);
	for (var i = 0; i < storedFiles.length; i++) 
	{
		
		if (new Date(storedFiles[i]).toString() == date.toString()) 
		{
            return [true, 'highlight'];
        }
    }
    return [true, ''];
}
	$('.reshedule_meeting,.accept_meeting,.cancel_meeting').css('display','none');
	$("#reshedule_meeting").click(function(e)
	{	
		var meeting_id = $('#meeting_id').val();
		location.href="{{ url('reshedule_meeting') }}/"+meeting_id;	
	});
	$(document).on('click','#show_meeting',function()
	{	
		$('.description').val('');
		$('.meeting_date').val('');
		$('.meeting_time').val('');
		$('.cancel_msg').text('');
		$(".pageloader").show();
    var meeting_id =$(this).attr('data-id');
    $('#meeting_id').val(meeting_id);
 	var geturl ="{{ url('getmeeting_details') }}/"+meeting_id;
		$.ajax({
		type:'GET',
		url:geturl,
		//  data:{meeting_date:meeting_date},
		success:function(data)
		{//$('.meeting_modal').trigger('click');
			if(data.status_code =='200')
			{
				$(".pageloader").hide();
				console.log(data.meeting_details);
				$('.description').val(data.meeting_details.description);
				$('.meeting_date').val(data.meeting_details.meeting_date);
				$('.meeting_time').val(data.meeting_details.meeting_time);
				//alert(data.meeting_details.type+'--'+data.meeting_details.type_id+'--'+data.user_type_id);
				if(data.meeting_status == "Accepted")
				{
					$('.accept_meeting').css('display','none');
					$('.acceptmeeting').css('display','none');
					$('.cancel_meeting').css('display','block');
					$('.cancelmeeting').css('display','block');
					//$('.reshedule_meeting').css('display','none');
				}
				if(data.meeting_status == "Rejected")
				{
					//$('.accept_meeting').css('display','block');
					//$('.cancel_meeting').css('display','none');
					$('.cancel_msg').text('The Meeting has been cancelled');
				}
				if((data.meeting_details.type == "Admin") & (data.meeting_details.type_id == data.user_type_id))
				{
					//$('.accept_meeting').css('display','none');
					//$('.cancel_meeting').css('display','none');
					$('.reshedule_meeting').css('display','block');
					$('.reshedulemeeting').css('display','block');
				}
				if(data.meeting_status == "")
				{
					if((data.meeting_details.type != "Admin") & (data.meeting_details.type_id != data.user_type_id))
					{
					$('.accept_meeting').css('display','block');
					$('.acceptmeeting').css('display','block');
					}
					$('.cancel_meeting').css('display','block');
					$('.cancelmeeting').css('display','block');
				}
						  
			}
			else
			{
						
			}
			

		}

		});	
	});
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
	var meeting_date ='2020-10-12';	
		
		
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



		$(document).on('click','#accept_meeting',function()
	{					
		var meeting_id = $('#meeting_id').val();
		var reason = $(this).attr('data-reason');
		var status = $(this).attr('data-status');
		var formdata = $(".create_meeting_form").serialize();
		formdata += '&meeting_id='+meeting_id+'&reason='+reason+'&status='+status;
		console.log(formdata);
		$.ajax({
		type:'POST',
		url:"{{ url('accept_reject_meeting_details') }}",
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
				var url ="{{ url('createmeeting') }}";
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
				var url ="{{ url('createmeeting') }}";
				window.location.href=url;
				}, 2000);		
			}

		}

		});	
			
				
	});
});
</script>
