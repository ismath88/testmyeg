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
			{{ $result['country_list'] }}
			@foreach($result['country_list'] as $key=>$value)
			{{  $value->country_name }}
			@endforeach
			 <div id="map" style="width:100%;height:400px;"></div>
				<style>
				#mapCanvas12 {
    width: 100%;
    height: 650px;
}
				</style>
				<div id="mapCanvas12"></div>
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

	function initMap() {
		var mapLayer = document.getElementById("map");
		var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
		var defaultOptions = { center: centerCoordinates, zoom: 4 }

		map = new google.maps.Map(mapLayer, defaultOptions);
		geocoder = new google.maps.Geocoder();
		
		<?php
		if (! empty($result['country_list'])) {
		    foreach($result['country_list'] as $key=>$value) {
		        ?>  
		         	geocoder.geocode( { 'address': '<?php echo $value->country_name; ?>' }, function(LocationResult, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							var latitude = 20.593684;
		var longitude = 78.96288;
						} 
		        	    		new google.maps.Marker({
		            	        position: new google.maps.LatLng(latitude, longitude),
		            	        map: map,
		            	        title: '<?php echo $value->country_name; ?>'
		            	    });
					});
			    <?php
		    }
		}
		?>		
	}
	
	  function load() {

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 45.327168, lng: 14.442902},
            zoom: 13
        });           

        for(var i = 0; i < markers.length; i++){
            marks[i] = addMarker(markers[i]);
        }
    }
	
	function addMarker(marker){
        var sadrzaj = marker.country_name};
        var adresa = marker.country_name;
        var grad = marker.country_name;
        var postanskibroj = marker.country_name;
        var zupanija = marker.country_name;
		var lat = 20.593684;
		var lng = 78.96288;

        var html = "<b>" + sadrzaj + "</b> <br/>" + adresa +",<br/>"+postanskibroj+" "+grad+",<br/>"+zupanija;


        var markerLatlng = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));


        var mark = new google.maps.Marker({
            map: map,
            position: markerLatlng,
            icon: customLabel['restaurant'],
			//icon: marker.slika
        });

        var infoWindow = new google.maps.InfoWindow;
        google.maps.event.addListener(mark, 'click', function(){
            infoWindow.setContent(html);
            infoWindow.open(map, mark);
        });

        return mark;
    }

    function doNothing(){} //very appropriately named function. whats it for?
	 //google.maps.event.addDomListener(window, 'load', load);  
    </script>
	
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnyJJ2gorvX0rsuhBJLNUsfyioWSSep2Q&callback=initMap">
    </script>
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnyJJ2gorvX0rsuhBJLNUsfyioWSSep2Q"></script>
<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas12"), mapOptions);
    map.setTilt(100);
        
    // Multiple markers location, latitude, and longitude
    var markers = [
        
		<?php
		if (! empty($result['country_list'])) {
		    foreach($result['country_list'] as $key=>$value) {
				echo '["'.$value->country_name.'", '.$value->country_name.', '.$value->country_name.', "'.$value->country_name.'"],'; 
			}
		}			?>
		/*if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                echo '["'.$row['name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['icon'].'"],'; 
            } 
        }*/ 
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php if (! empty($result['country_list'])) {
		    foreach($result['country_list'] as $key=>$value) { ?>
                ['<div class="info_content">' +
                '<h3><?php $value->country_name; ?></h3>' +
                '<p><?php $value->country_name; ?></p>' + '</div>'],
        <?php } 
        } 
        ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
		var latitude = 20.593684;
							var longitude = 78.96288;
        var position = new google.maps.LatLng(latitude, longitude);
		//var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: markers[i][3],
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
}

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>

