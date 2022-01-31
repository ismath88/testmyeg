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
#hide_div
{
	display:none;
}
#show_div
{
	display:block;
}
.error
{
	color:red;
	font-size:11px;
}
</style>
  <div class="container account-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
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
			<!-- Modal -->	
<div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">	
			<div class="modal-dialog modal-dialog-centered" role="document">	
				<div class="modal-content">	
				<div class="modal-header">	
					<h5 class="modal-title" id="exampleModalCenterTitle">Team Members List </h5>	
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">	
					<span aria-hidden="true">&times;</span>	
					</button>	
				</div>	
				<div class="modal-body">	
					<!-- working area -->	
					<div class="row" style="max-height:300px;overflow-x:auto">	
					<table  class="table" style="width:100%">	
						
							<tr>	
							<th>&nbsp;</th>	
							<th class="text-center">S.NO</th>	
							<th class="text-center">Name</th>	
							<th>&nbsp;</th>	
							</tr>	
						<body>	
						@if(count($result['sub_users']) > 0)
						@foreach($result['sub_users'] as $key=>$value)	
						<tr>	
						<td class="text-center"><input type="checkbox" class="agents" id="{{$value->id.'~'.$value->name.'~'.$value->email}}"></td>	
						<td class="text-center">{{ ($key + 1) }}</td>	
						<td class="text-center">{{ $value->email }}</td>	
						<td></td>	
						</tr>	
						@endforeach	
						@else
						<tr>	
						<td class="text-center" colspan='4'>No Data Found</td>	
						<td></td>	
						</tr>
						@endif
					</table>	
						
						
					</div>  	
					<div class="modal-footer">
					<button type="button" class="btn btn-primary choose_agents" id="newinvites">Submit</button>
				</div>
					<!-- working area -->	
				</div>	
				</div>	
			</div>	
			</div>	
			<!-- Modal -->	

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
				<span class="height-null align-middle pl-2 font-10 grey-text">This month</span>
				</div>
				</div>
				<div class="total-app active pb-2  p-3 card col-5 mr-3 trans-border event-box-shadow">
				<h5 class="font-12 font-weight-bold mb-0">Application Sent</h5>
				<div class="w-100 mx-auto my-0 px-0">
				<span class="blue-text font-24 height-null">{{ $result['application_sent'] }}</span>
				<span class="height-null align-middle pl-2 font-10 grey-text">This month</span>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>


				<!--2ND ROW-->
				
				<div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
					<div class="uni-left-card border-remove-right card">
					<div class="heading-calendar mt-3 d-flex col-12">
					<h5 class="mb-0 app-sub-heading font-26 font-weight-bold col-6 px-0">Create Meeting</h5>
					</div>


				<div class="px-0 pt-4 univ-crt-meet-right-block card-body">
					<div class="uni-right-card uni-aboutus col-md-12">
					<form action="" method="post" class="add_studentlibrary_form" id="add_studentlibrary_form" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="px-3 py-4 card-body">
					<label for="city" class="uni-label">TITLE</label>
					<div class="col-12 col-md-12 col-lg-12 col-xl-12">
					<div class="row px-3 form-group">
					<div class="px-0 upload-btn-wrapper col-9 d-flex row comm-border p-1">
					<input placeholder="Preliminary interview Invitation" type="text" class="col-7 border-transparent height-no form-control title fields" id="title" name="title" required>
					
					<button class="edit- btn btn-primary blue-otln-ntn col-5  d-flex justify-content-center description_add" type="button">+ Add description</button>
					</div>

					<div class="col-3 row mx-auto"><img src="/img/camcorder.svg" width="" class="mr-1">
					<img src="/img/stat.svg" width="" class="mr-1">
					<img src="/img/callicon.svg" width="" class="mr-1">
					</div>
					</div>
					<span class="error title_error" id="error_title">This value is required.</span>
					<h6 style="color: red;"></h6>
					</div>

					<div class="my-0 row form-group description_div" id="hide_div">
						<div class="col-12 col-md-4 col-lg-4 col-xl-4">
						
						<label class="uni-label">Description</label>
						<div class="form-group"><div class="">
						<textarea  class="meeting-input form-control description" id="description" name="description"></textarea>
						</div>
						
						</div>
					</div>
					</div>

					<div class="my-0 row form-group">
					<div class="col-12 col-md-4 col-lg-4 col-xl-4 pr-2">
					<label class="uni-label">DAY</label>
					<div class="form-group"><div class="cal-event">
					<input type="text" name="meeting_date" class="meeting-input form-control meeting_date fields" id="meeting_date">
					<span class="error meeting_date_error" id="error_meeting_date">This value is required.</span>
					</div>
					</div>
					<h6 style="color: red;"></h6>
					</div>
					<div class="row col-12 col-md-4 col-lg-4 col-xl-4 pr-2">
					<div class="col-12 col-md-6 col-lg-6 col-xl-6 pr-2 pl-0">
					<label class="uni-label">From</label>
					<div class="form-group time-event">
					<!-- <input type="number" class="form-control from_time" id="from_time" name="from_time" value="10am"> -->
					<select  class="form-control from_time fields" id="from_time" name="from_time" >
					<option value=""> Select </option>
					@foreach($result['times'] as $val)
					<option value="{{ $val }}"> {{ $val }} </option>
					@endforeach
					</select>
					<span class="error from_time_error" id="error_from_time">This value is required.</span>
					</div></div>
					<div class="col-12 col-md-6 col-lg-6 col-xl-6 pr-1 pl-0">
					<label class="uni-label">To</label>
					<div class="form-group time-event">
					<select  class="form-control to_time fields" id="to_time" name="to_time" >
					<option value=""> Select </option>
					@foreach($result['times'] as $val)
					<option value="{{ $val }}"> {{ $val }} </option>
					@endforeach
					</select>
					<span class="error to_time_error" id="error_to_time">This value is required.</span>
					</div>
					</div>
					</div>
					<div class="col-12 col-md-4 col-lg-4 col-xl-4 pl-3">
					<label class="uni-label">SET REMINDER</label>
					<div class="inbox-page form-group">
					<select class="pr-5 form-control set_reminder fields" id="set_reminder" name="set_reminder">
					<option value="0">At time of event</option>
					<option value="5">5 Minutes before</option>
					<option value="10">10 Minutes before</option>
					<option value="15">15 Minutes before</option>
					<option value="30">30 Minutes before</option>
					<option value="60">1 Hour before</option>
					<option value="120">2 Hour before</option>
					<option value="1440">1 Day before</option>
					<option value="2880">2 Days before</option>
					</select>
					<span class="error set_reminder_error" id="error_set_reminder">This value is required.</span>
					</div>
					</div>

					<div class="col-12 col-md-12 col-lg-4 col-xl-12">
					<hr>
					<img src="/img/correct-green.png" width="12">
					<span class="font-10 align-middle grey-text">This Video Wll Take Place On <span class="meet_date"></span> From <span class="meet_from"></span></span>
					</div>
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
					<label class="uni-label mt-3">ADD TEAM MEMBER</label>
					<div class="form-group">
					<div class="mr-3 send-icon mb-4" style="display:inline-flex">
					
					<div class="members">
					<!-- <button class="edit-btn btn btn-orange tick-top mr-0">LA</button>
					<img src="/img/correct-green.png" width="12" class="tick-suffix p-0 border-transparent ">
					<button class="edit- btn btn-primary blue-btn-dash tick-top mr-0">JB</button>
					<img src="/img/correct-green.png" width="12" class="tick-suffix p-0 border-transparent mr-3"> -->
					</div>
					<a data-toggle="modal" data-target="#agentModal">
					<button class="send-btn btn btn-primary mr-3 blue-otln-ntn p-0 py-2" type="button">
					<div class="border-white d-flex">
					
					<img class="mr-2 p-0 mx-2 my-0 border-transparent" src="/img/planeicon.svg" alt="" width="20">
					<span class="mr-2 align-self-center">+</span>
					</div>
					</button>
					</a>
					</div>
					</div>
					</div>
					<div class="col-5 col-md-5 col-lg-5 col-xl-5">
					<label class="uni-label mt-3">ADD CLIENT</label>
					<div class="form-group">
					<div class="px-0 upload-btn-wrapper col-12 row d-flex comm-border p-1">
					<input placeholder="Email Invitation" type="text" class="col-12 border-transparent height-no form-control mail_to fields" name="mail_to" id="mail_to" style="text-transform:none">
					<span class="error mail_to_error" id="error_mail_to">This value is required.</span>
					</div>
					</div>
					<h6 style="color: red;"></h6>
					</div>
					</div>
					<div class="row form-group"><div class="col-md-12">
					<hr><label for="file-multiple-input" class="uni-label pt-2 pb-2">UPLOAD ATTACHMENTS</label>
					</div>
					
					<div class="col-12 col-md-9">
					<div id="output"></div>
					<div class="row mb-3 file-uploading font-12">
					<div class="col-2">
					</div>
					<div class="col-6 pt-1 px-0"> 
					</div>
					<div class="col-2 pt-1 px-0 selFile">  
					</div>
					</div>
					</div>

					<div class="text-right col-12 col-md-3">
					<div class="upload-btn-wrapper">
					<button class="btn">+ Add Files</button>
					<!-- <input accept="image/*" name="upload_photo[]" type="file" files class="form-control-file"> -->
					<input type="file" id="files" multiple>
					</div>
					</div>
					</div>
					<div class="uni-drag-drop row"><div class="col-12">
					<div class="upload-drop-zone" id="drop-zone">
					<img src="/img/uploadicon.svg" alt="" width=""> 
					<span class="align-middle">You can also drop your files here</span>
					</div>
					</div>
					<div class="col-12 text-center"><div class="col-7 mx-auto upload-btn-wrapper ">
					<hr>
					<button class="btn w-75 mx-auto d-flex justify-content-center evevt-crt create_event" type="button">Create Event</button>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>

</form>










				<!--<div class="col-md-12 sub-header px-0 d-flex col-12">
					<a class="select-btn header active" href="{{ url('university/performanceapplication') }}">Applications</a>
					<a class="select-btn header" href="{{ url('university/performancestudent') }}">Student Enrollment</a>
					<a class="select-btn header">Sales and Commissions</a>
				</div>
			
			<div class="col-md-12 col-12 ">
            <div class="col-lg-11 col-lg-11 col-12 ml-5 mt-5">
			<div class="row mx-0 mb-3">
				<h5 class="pl-3">Statistics </h5>
			</div>
			<div class="row mx-0 mb-3">
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
						<div class="degree-text">Applications Sent</div>
						<div class="degree-number">5 <span>This Month</span></div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
						<div class="degree-text">Applications Rejected</div>
						<div class="degree-number">12 <span>This Month</span></div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
						<div class="degree-text">Applications Approved</div>
						<div class="degree-number">10 <span>This Month</span></div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
						<div class="degree-text">Applications Rejected</div>
						<div class="reject-number">$1,380,649</div>
						<div class="row pt-2"><div class="col dates">Day</div><div class="col dates active px-0">Week</div>
						<div class="col dates pr-0">Month</div> <div class="col dates">Year</div>
						</div>
					</div>
				</div>
			</div>
				<div><img height="" width="100%" src="img/performance-app.jpg"/></div>	
			</div>
				
            </div>-->






            <!-- END -->
            </div>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

	<script>
	
$( document ).ready(function() {
	$('.error').css('display','none');
	$('.client_id_error').css('display','none');	
	$('.client_secret_error').css('display','none');
	$.noConflict();	
	$( "#datepicker" ).datepicker();
	$( "#meeting_date" ).datepicker({
  dateFormat: "yy-mm-dd",
  minDate: 0,
  onSelect: function (date) {
	  $('.meet_date').text(date);
  }
 });
 
	$('.error_cur,.error_new,.error_confirm,.invalid_password').css('display','none');
	$("body").on("click", ".selFile", removeFile);
	$("#files").on("change", handleFileSelect);
var selDiv = "";
// var selDivM="";
var storedFiles = [];

function handleFileSelect(e) {
  var files = e.target.files;
  var filesArr = Array.prototype.slice.call(files);
  var device = $(e.target).data("device");
  filesArr.forEach(function(f) {
	  /*
    if (!f.type.match("image.*")) {
      return;
	}
	*/
    storedFiles.push(f);
    var reader = new FileReader();
    reader.onload = function(e) {
		var data ='<div class="row mb-3 font-12"><div class="col-2"><img src="/img/file-icon.svg" width="" alt=""> </div><div class="col-6 pt-1 px-0">'+f.name+'</div><div class="col-2 pt-1 px-0 selFile" data-file="' + f.name + '"> Remove </div></div>';
      var html = "<div><img height='30' src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'>" + f.name + "<br clear=\"left\"/></div>";
      $("#output").append(data);
    }
    reader.readAsDataURL(f);
  });
}

function removeFile(e) {
	
  var file = $(this).data("file");
 
  for (var i = 0; i < storedFiles.length; i++) {
    if (storedFiles[i].name === file) {
      storedFiles.splice(i, 1);
      break;
    }
  }
  $(this).parent().remove();
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
$(document).on('change',".from_time",function(e)	
	{
$('.meet_from').text($(this).val());
	});
	$(document).on('click',".description_add",function(e)	
	 {
		var desdiv = $('.description_div').attr('id');
		
		if(desdiv == "show_div")
			$('.description_div').attr('id','hide_div')
			if(desdiv == "hide_div")
			$('.description_div').attr('id','show_div')

	 });
	var agentListArr = [];
	var useremailArr = [];
		
	$(document).on('click',".choose_agents",function(e)	
	 {
		$('#agent_content').html('');
		var content = '';
		agentListArr.length = 0;
		useremailArr.length = 0;
		var colors = ["orange", "blue"];
		var colorcls = 0;
		$('.agents').each(function (index, obj) 
		{
			if (this.checked === true) 
			{
				var valu = $(this).attr('id');
				var agentArr = valu.split('~');
				if(agentArr[2] != "")
				{
					var url ="{{ url('Agent') }}/"+agentArr[2];
				}
				else
				{
					var url ="{{ url('img/formee_logo_dark.svg') }}";
				}
				content += '<button class="edit-btn btn btn-orange tick-top mr-0">'+(agentArr[1].substring(0,2)).toUpperCase()+'</button>'+"\n"
				+'<img src="/img/correct-green.png" width="12" class="tick-suffix p-0 border-transparent ">'+"\n"				
							
				agentListArr.push(agentArr[0]);
				useremailArr.push(agentArr[2]);
				
			}
		
		});
		$('.members').append(content);
		$('.close').trigger('click');
		$('#agentModal').modal('toggle');
		$('.agents').prop('checked',false);
		
	 });
function convertTime12to24(time12h) {
  const [time, modifier] = time12h.split(' ');

  let [hours, minutes] = time.split(':');

  if (hours === '12') {
    hours = '00';
  }

  if (modifier === 'PM') {
    hours = parseInt(hours, 10) + 12;
  }

  return `${hours}:${minutes}`;
}
	 $(".create_event").click(function(e)
	{	

	var startTime = convertTime12to24($('.from_time').val());
	var endTime = convertTime12to24($('.to_time').val());
	
	
	
		var count = 0;
		$('.fields').each(function()
		{
			var className = $(this).attr('name');
			if($('.'+className).val() == "")
			{
				count++;
				$('#error_'+className).css('display','block');
			}
			else
			{
				/*
				if(className == "mail_to")
				{
					var email = $('.'+className).val();
					var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(!regex.test(email)) 
					{
						count++;
						$('#error_'+className).text('Enter Valid Email ID');	
						$('#error_'+className).css('display','block');	
					}
				}
				else
				{
				$('#error_'+className).css('display','none');
				}
				*/
				$('#error_'+className).css('display','none');
			}

		});
		if(count <= 0)
		{
			if (moment(startTime, ["h:mm A"]).format("HH:mm") > moment(endTime, ["h:mm A"]).format("HH:mm")) 
			{
				$('#error_to_time').text('Please Enter To Time is less then From Time.');	
				$('#error_to_time').css('display','block');	
			}
			else
			{
		var form = $(".add_studentlibrary_form");
		//form.parsley().validate();
		//if(form.parsley().isValid()){
			$(".pageloader").show();
			
	  var formData = new FormData($('#add_studentlibrary_form')[0]);
		
   for (var i = 0, len = storedFiles.length; i < len; i++) 
   {
    formData.append('files[]', storedFiles[i]);
   }
   for (var i = 0, len = agentListArr.length; i < len; i++) 
   {
	formData.append('user_list[]', agentListArr[i]);
	}
	for (var i = 0, len = useremailArr.length; i < len; i++) 
   {
	formData.append('user_emaillist[]', useremailArr[i]);
	}
	//formData.append('user_emaillist[]', $('.mail_to').val());
        $.ajax({
            url: "{{ route('create_meeting.post') }}",
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
				   $(".pageloader").hide();
					
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
				   setTimeout(function(){ 
					var url ="{{ url('createmeeting') }}";
					window.location.href=url;
				   }, 2000);
            }
		});
	}
		}
				
	});	




});
</script>
