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
				<div class="col-md-12 sub-header px-0 d-flex col-12">
					<a class="select-btn header active" href="{{ url('university/performanceapplication') }}">Applications</a>
					<a class="select-btn header" href="{{ url('university/performancestudent') }}">Student Enrollment</a>
					<a class="select-btn header">Sales and Commissions</a>
				</div>
			
			<div class="col-md-12 col-12 ">
            <div class="col-lg-11 col-lg-11 col-12 ml-5 mt-5">
			<div class="row mx-0 mb-3">
				<h5 class="pl-3">Statistics </h5>
			</div><!--{{ $result['country_list'] }}
						@foreach($result['country_list'] as $key=>$value)
						{{  $value->country_name }}
						@endforeach  -->
			
			<div class="row mx-0 mb-3">
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
						<div class="degree-text">Applications Sent</div>
						<div class="degree-number">{{$result['application_sent']}} <span><?= date('F Y') ?></span></div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
						<div class="degree-text">Applications Rejected</div>
						<div class="degree-number">{{$result['application_rejected']}} <span><?= date('F Y') ?></span></div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
						<div class="degree-text">Applications Approved</div>
						<div class="degree-number">{{$result['application_approved']}} <span><?= date('F Y') ?></span></div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
						<div class="degree-text">Applications Approved</div>
						<div class="reject-number ">  $<span class="approve_amt_val">{{$result['approved_application_amt']}}</span></div>  
						<div class="row pt-2 "><div class="col dates day_btn"><?= date('Y-m-d') ?></div><div class="col dates active px-0 week_btn"><?php 
						$first_pair = date('Y-m-d', strtotime('monday this week'));
						$start_time = strtotime($first_pair);
						$end_time = strtotime("+6 day", $start_time);
						$second_pair = date('Y-m-d', $end_time);
						echo date('M d', $start_time).'-'.date('M d', $end_time)						
						?></div>     
						<div class="col dates pr-0 month_btn"><?= date('F Y') ?></div> <div class="col dates year_btn"><?= date('Y') ?></div>
						</div>
						
						
						
						
					</div>
				</div>

			</div><!--{{$result['total_application']}}
				
				{{ $result['country_list'] }}
			@foreach($result['country_list'] as $key=>$value)
			{{  $value->country_name }}
			@endforeach  -->
			 <!--div id="map" style="width:100%;height:400px;"></div>
				</div-->
				<!--div><img height="" width="100%" src="img/performance-app.jpg"/></div-->	

			</div>
			<div class="row">
				<div class="col-md-9 dash-app-county">
					
				
					<div class=""><div id="map" style="width:100%;height:400px;"></div><!--img height="" width="100%" src="img/performance-app.jpg"/--></div>	
					<div class="row">
						<div class="col-3">
								<select class="form-control box-size" name="select_country" id="select_country" >
									<option value="" readonly>Select Country</option>
									   @if(!empty($result['total_country_list']))
									   @foreach($result['total_country_list'] as $key=>$value)				  
										<option value="{{$value->id.'-'.$value->country_name}}" >{{$value->country_name}}</option> 
									  @endforeach
									   @else
									   @endif
								  </select>
						</div> 
						<div class="container" id="search_countrysresult">  
						@forelse($result['total_application'] as $key=>$value)
							   <div class="col-2 pick_country_id" id="{{$value->country_id}}">
							   <!--input type="hidden" class="" name="pick_country_id" id="pick_country_id" value="{{$value->country_id}} " /-->
							   {{$value->country_name}} 
							   </div>
							   @empty
							<hr><?php $last_country_id = $value->id ?>
							<p>No records found</p>
							<?php $last_country_id = 0; ?>
						@endforelse
				
			
			
						<!--div class="col-2">Select </div>
						<div class="col-2">Select </div>
						<div class="col-2">Select </div>
						<div class="col-1">UK </div-->
						<div class="col-1 more-county search-button load_button">
						<button class="button button3" name="btn_more" data-vid="<?php if(empty($last_country_id)){ echo 0; } else { echo $last_country_id; } ?>" id="btn_more"><img height="" width="16" src="img/more.svg"/></button></div>
						<!--div class="col-1 more-county"><img height="" width="16" src="img/more.svg"/> </div-->   
						
						</div>
						<div id="counter">1</div>
					</div>
				</div>
				<div class="col-md-3 dash-app-count">
					<div class="row">
						<div class="col-12"><p>Total Application</p> <div class="app-list blue-bor"> <?php echo $result['total_applicationby_country']; ?></div> </div>
						<div class="col-12"><p>Approved Application</p> <div class="app-list green-bor"><?php echo $result['total_approved_applicationby_country']; ?></div> </div>
						<div class="col-12"><p>Rejected Application</p> <div class="app-list red-bor"> <?php echo $result['total_rejected_applicationby_country']; ?></div> </div>
						
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
<script  src="{{ url('js/parsley.min.js') }}" defer></script>
<script  src="{{ url('js/parsley.js') }}" defer></script>
<script  src="{{ url('js/jquery.min.js') }}"></script>
	<script>
$( document ).ready(function() {
	
	$('.day_btn').click(function (e) { 
	var mode = 'day';
		$(".approve_amt_val").html('');
		$.ajax({
				type:"GET",
				url: 'get_application_amount_total',
				data: {mode: mode},
				success: function(data) {
					$(".approve_amt_val").html(data);
				}
		});
	
	});
	$('.week_btn').click(function (e) { 
	var mode = 'week';
		$(".approve_amt_val").html('');
		$.ajax({
				type:"GET",
				url: 'get_application_amount_total',
				data: {mode: mode},
				success: function(data) {
					$(".approve_amt_val").html(data);
				}
		});
	
	});
	$('.year_btn').click(function (e) { 
	var mode = 'year';
		$(".approve_amt_val").html('');
		$.ajax({
				type:"GET",
				url: 'get_application_amount_total',
				data: {mode: mode},
				success: function(data) {
					$(".approve_amt_val").html(data);
				}  
		});
	
	});
	$('.month_btn').click(function (e) { 
	var mode = 'month';
		$(".approve_amt_val").html('');
		$.ajax({
				type:"GET",
				url: 'get_application_amount_total',
				data: {mode: mode},
				success: function(data) {
					$(".approve_amt_val").html(data);
				}
		});
	
	});
	var count = 1;
	$(document).on('click', '#btn_more', function(){  
				var last_country_id = $(this).data("vid");
				$('#btn_more').html("Loading...");
				 count++;
    //$("#counter").html("My current count is: "+count);
	var counter_val = count;
				$('#search_countrysresult').html('');
				$.ajax({  
					url:"load_more_country_list",  
					method:"GET",  
					data: { last_country_id:last_country_id, counter_val:counter_val},							
					dataType:"text",  
					success:function(data)  
					{  
						// alert(data);
						if(data != '')   
						{  
							$('.load_button').remove();  
							
							 $('#search_countrysresult').html(data);	
						}  
						else  
						{  
							$('#btn_more').html("No Data");  
						}  
					}  
				});  
				   
			});
	
	
	$('.pick_country_id').click(function(event) {
		var country_id = $(this).attr('id');
		window.location.href = 'university/performanceapplication?country_id=' + country_id;
	});
	
	
	$('#select_country').change(function () { 
			
			var select_country = $('#select_country').val(); 
			var country_id = select_country.split("-")[0];
			var country_name = select_country.split("-")[1];
			
			window.location.href = 'university/performanceapplication?country_id=' + country_id;			
			/*$.ajax({
				url: 'get_applicationscount_bycountry',        
				type: "get",
				data: {country_id:country_id},
				success: function(data){
					 
					 var res = data.split("@@");
					 alert(res[0]);
					 //$("#result_container_chart").html(res[0]); 
				}
			});*/
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

<script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };
	 var map;
	 var markers = {!! json_encode($result['country_list']) !!};
     //this should dump a javascript array object which does not need any extra interperting.
     var marks = []; //just incase you want to be able to manipulate this later
    
	var map;
	var geocoder;
var marker;	
var infowindow;

	function initMap() {
		var mapLayer = document.getElementById("map");
		var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
		var defaultOptions = { center: centerCoordinates, zoom: 1 }

		map = new google.maps.Map(mapLayer, defaultOptions);
		geocoder = new google.maps.Geocoder();
		
		<?php
		if (! empty($result['country_list'])) {
		    foreach($result['country_list'] as $key=>$value) {
				$address = $value->country_name; // Google HQ
				 $prepAddr = str_replace(' ','+',$address);
				 $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyCnyJJ2gorvX0rsuhBJLNUsfyioWSSep2Q&address='.$prepAddr.'&sensor=false');
				 $output= json_decode($geocode);
		
				$latitude = $output->results[0]->geometry->location->lat;
				$longitude = $output->results[0]->geometry->location->lng;
				
		        ?>  
		         	geocoder.geocode( { 'address': '<?php echo $value->country_name; ?>' }, function(LocationResult, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							//var latitude = 20.593684;
							//var longitude = 78.96288;
							var latitude = '<?php echo $latitude ?>';
							var longitude = '<?php echo $longitude ?>';
						} 
						marker = new google.maps.Marker({
						map: map,
						position: new google.maps.LatLng(latitude, longitude),
						map: map,
						title: '<?php echo $value->country_name; ?>'
					});
					
					  var html = "<b>" + '<?php echo $value->country_name; ?>' + "</b> <br/>"+ '<?php echo $result['total_applicationby_country']; ?>' +" - All Application,<br/>"+ '<?php echo $result['total_approved_applicationby_country']; ?>' +" - Approved,<br/> "+'<?php echo $result['total_rejected_applicationby_country']; ?>'+" - Rejected<br/>";
					 infowindow = new google.maps.InfoWindow({
						  content:"Hello World!"
					});

					google.maps.event.addListener(marker, 'click', function() {
					  //alert('hi');
					  infowindow.setContent(html);
						infowindow.open(map,marker);
					});
					});
			    <?php
		    }
		}
		?>		
	}
	
    </script>
	
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnyJJ2gorvX0rsuhBJLNUsfyioWSSep2Q&callback=initMap">
    </script>
