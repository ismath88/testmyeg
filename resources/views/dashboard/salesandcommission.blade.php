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
					<a class="select-btn header " href="{{ url('university/performanceapplication') }}">Applications</a>
					<a class="select-btn header" href="{{ url('university/performancestudent') }}">Student Enrollment</a>
					<a class="select-btn header active" href="{{ url('university/salesandcommission') }}">Sales and Commissions</a>
				</div>
			
			<div class="col-md-12 col-12 ">
            <div class="col-lg-12 col-lg-12 col-12 mt-5 px-0">
			<div class="row mx-0 mb-3">
				<h5 class="pl-3"> STATISTICS </h5>
			</div>
			
			<div class="row mx-0 mb-3">
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
					<div class="row col-12">
						<div class="degree-text col-9">Total Sales</div>
						<div class="degree-text col-3"> 
						
						<div class="dropdown">
						<button class="btn btn-default dropdown-toggle p-0 curr-drop-btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						All
							<span class="caret"></span>
						</button>
						<ul class=" currency-drop dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a  class="total_sales currencybasedamount"  id="totalsales"   data-value="{{ $result['totalamount'] }}">All</a></li>
						@foreach($result['total_sales'] as $key=>$value)
							<li><a  class="total_sales currencybasedamount" id="totalsales" data-id="{{ $value->currency_id }}"  data-value="{{ $value->total_amount }}">{{ $value->currency_code }}</a></li>
						@endforeach
						</ul>
						</div>
						
						</div>
						</div>
						<div class="degree-number totalsales">{{$result['totalamount']}} <span></span></div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
					<div class="row col-12">
						<div class="degree-text col-9">Total Commission Received</div>
						<div class="degree-text col-3"> 
						
						<div class="dropdown">
						<button class="btn btn-default dropdown-toggle p-0 curr-drop-btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						All
							<span class="caret"></span>
						</button>
						<ul class=" currency-drop dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a  class="total_sales currencybasedamount"  id="totalcommrec"   data-value="{{ $result['totalcommissionrec'] }}">All</a></li>
						@foreach($result['total_commission_rec'] as $key=>$value)
							<li><a  class="total_sales currencybasedamount" id="totalcommrec" data-id="{{ $value->currency_id }}"  data-value="{{ $value->total_amount }}">{{ $value->currency_code }}</a></li>
						@endforeach
						</ul>
						</div>
						
						</div>


					</div>
						<div class="degree-number totalcommrec" >{{$result['totalcommissionrec']}} <span></span></div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
					<div class="row col-12">
						<div class="degree-text col-9">Total Commission Sent</div>
						<div class="degree-text col-3"> 
						
						<div class="dropdown">
						<button class="btn btn-default dropdown-toggle p-0 curr-drop-btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						All
							<span class="caret"></span>
						</button>
						<ul class=" currency-drop dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a  class="total_sales currencybasedamount"  id="totalcommsent"   data-value="{{ $result['totalamount_sent'] }}">All</a></li>
						@foreach($result['total_sales_sent'] as $key=>$value)
							<li><a  class="total_sales currencybasedamount"  id="totalcommsent" data-id="{{ $value->currency_id }}"  data-value="{{ $value->total_amount }}">{{ $value->currency_code }}</a></li>
						@endforeach
						</ul>
						</div>
					</div>
						<div class="degree-number totalcommsent">{{$result['totalamount_sent']}} <span></span></div>
					</div>
				</div>
				</div>
				<div class="col-md-3 col-lg-3 date-box uni-no-padd">
					<div class="date-inner">
					<div class="row col-12">
						<div class="degree-text col-9">Total Revenue</div>
						<div class="degree-text col-3"> 
						
						<div class="dropdown">
						<button class="btn btn-default dropdown-toggle p-0 curr-drop-btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						All
							<span class="caret"></span>
						</button>
						<ul class=" currency-drop dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a  class="total_sales currencybasedamount"  id="total_revenue"   data-value="{{$result['total_revenue']}}">All</a></li>
						@foreach($result['currencies_id'] as $key=>$value)
						<li><a  class="total_sales currencybasedamount"  id="total_revenue" data-id="{{ $value }}"  data-value="{{ array_sum($result[$value]) }}">{{ $result['currencies_code'][$value] }}</a></li>
						@endforeach
						</ul>
						</div>
					
					
					</div>
						<!-- <div class="reject-number text-left">  <span class="approve_amt_val">{{$result['total_revenue']}}</span></div>  -->
						<div class="degree-number total_revenue">{{$result['total_revenue']}} <span></span></div> 
						<div class="row pt-2 col-12"><div class="col dates  currencybasedamount revenues"  id="total_revenue" data-value="{{ $result['today_revenue'] }}">Day<?php //echo date('Y-m-d') ?></div><div class="col dates revenues  px-0 currencybasedamount"  id="total_revenue" data-value="{{ $result['week_revenue'] }}">Week<?php 
						$first_pair = date('Y-m-d', strtotime('monday this week'));
						$start_time = strtotime($first_pair);
						$end_time = strtotime("+6 day", $start_time);
						$second_pair = date('Y-m-d', $end_time);
						//echo date('M d', $start_time).'-'.date('M d', $end_time)						
						?></div>     
						<div class="col dates pr-0 active revenues currencybasedamount" id="total_revenue" data-value="{{ $result['month_revenue'] }}">Month<?php // echo date('F Y'); ?></div> <div class="col dates revenues currencybasedamount"  id="total_revenue" data-value="{{ $result['year_revenue'] }}">Year<?php //echo date('Y') ?></div>
						</div>
						
					</div>
				</div>

			</div>
			</div>
			<div class="row mx-0 mb-4 px-0 box-shadow-show">
				<div class="col-md-12 dash-app-county card mb-0 px-0">
					<div id="map" style="width:100%;height:400px;"></div>
					<div class="d-flex px-4 mt-3 border-top">
						<div class="col-4 py-3">
								<select class="form-control box-size" name="select_country" id="select_country" >
									<option value="" readonly>Select Country</option>
									   @if(!empty($result['total_country_list']))
									   @foreach($result['total_country_list'] as $key=>$value)				  
										<option value="{{$value->id.'-'.$value->country_name}}" {{ ( $value->id == $result['country_id']) ? 'selected' : '' }} >{{$value->country_name}}</option> 
									  @endforeach
									   @else
									   @endif
								  </select>
						</div> 
						<div class="container col-8 pt-4 row text-right mx-0 sales-map-country" id="search_countrysresult">  
						@forelse($result['topfivecountry'] as $key=>$value)
							   <div class="col-2  pick_country_id dates ct_{{$value->country_id}}" id="{{$value->country_id}} ">
							   <!--input type="hidden" class="" name="pick_country_id" id="pick_country_id" value="{{$value->country_id}} " /-->
							   {{$value->country_name}} 
							   </div>
							   @empty
							<hr><?php $result['country_id'] = $value->id ?>
							<p>No records found</p>
							<?php $result['country_id'] = 0; ?>
						@endforelse 
				
						<!--div class="col-2 more-county search-button load_button">
						<a class="button button3" name="btn_more" data-vid="<?php if(empty($last_country_id)){ echo 0; } else { echo $last_country_id; } ?>" id="btn_more"><img height="" width="16px" src="img/more.svg"/></a></div-->
						</div>
						<div id="counter"></div>
					</div>
				</div>
				<!-- <div class="col-md-3 dash-app-count box-shadow-none card mb-0">
					<div class="row">
						<div class="col-12"><p>Total Application</p> <div class="app-list blue-bor"> <?php echo $result['total_applicationby_country']; ?></div> </div>
						<div class="col-12"><p>Approved Application</p> <div class="app-list green-bor"><?php echo $result['total_approved_applicationby_country']; ?></div> </div>
						<div class="col-12"><p>Rejected Application</p> <div class="app-list red-bor"> <?php echo $result['total_rejected_applicationby_country']; ?></div> </div>
						
					</div> -->
					
				</div>
				</div>

			</div>
				
            </div>
            <!-- END -->
            </div>
        </div>
    <!--/div>
	
</div-->  
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

	$(document).on('click','.currencybasedamount',function()
	{
    var id = $(this).attr('id');
    var amount = $(this).attr('data-value');
	$('.'+id).text(amount);
	})
	<?php
		if (! empty($result['country_list'])) {
		    foreach($result['country_list'] as $key=>$value) { ?>	
			var tt = "<?php echo $value->id; ?>";
			$(".ct_"+tt).addClass("active");   
			<?php
			}
		}?>
$(document).on('click','.revenues',function()
{
	$('.revenues').removeClass("active");
	$(this).addClass("active");
})
	
	
	
	
	
	$('.pick_country_id').click(function(event) {
		var country_id = $(this).attr('id');
		window.location.href = 'university/salesandcommission?country_id=' + country_id;
	});
	$(document).on('click', '.pick_country_id', function(){ 
  
});
	
	$(document).on('click', '#pick_country_id', function(){  
				var country_id = $(this).data("vid");
				window.location.href = 'university/salesandcommission?country_id=' + country_id;
	});
	
	$('#select_country').change(function () { 
			
			var select_country = $('#select_country').val(); 
			var country_id = select_country.split("-")[0];
			var country_name = select_country.split("-")[1];
			
			window.location.href = 'university/salesandcommission?country_id=' + country_id;			
			
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
	
	$('.error_cur,.error_new,.error_confirm,.invalid_password').css('display','none');
	
	$(".currency-drop li a").click(function(){
  $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
  $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
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
					
					  var html = "<b>" + '<?php echo $value->country_name; ?>' + "</b> <br/>"+ '<?php echo $result['totalamount_map']; ?>' +" - Total Sales,<br/>"+ '<?php echo $result['totalcommissionrec_map']; ?>' +" - Total Commission Received,<br/> "+'<?php echo $result['totalamount_sent_map']; ?>'+" - Total Commission Sent<br/>";
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
