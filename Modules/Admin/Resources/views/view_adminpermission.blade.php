@extends('layouts.app')

@section('content')
<style>
.permission
{
	padding:5px;
	margin-right:0px;
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
.invalid_password,.already,.notequalto
{
	color:red;
}
.notequalto
{
	color:red;
	font-size:10px;
}
#usergroup
{
	text-decoration:none;
	color:#3c4b64;
}
</style>
  <div class="admin-permission " >
        <div class="fade-in">
             <div class="row w-100">
				<div class="col-md-12 header-shadow sub-header  d-flex col-12" >
					@foreach($result['account_types']  as $val)
					<a  class="select-btn admingroup" data-id ="{{ $val->id }}" {{ $val->id == '1'  ? 'active' : ''}}>{{ $val->usergroup_name }}</a>
					@endforeach
					<a class="select-btn usergroup" id="usergroup" href='#addgroup'   data-toggle="modal">Add Group +</a>
				</div>
			
			<div class="container col-md-10 col-12 ">
			<form action='#' class="permission_form" method="post" >
				{{ csrf_field() }}
            <div class="col-md-10 col-lg-10 col-xl-7 col-12 ml-5 mt-5">
				<h5 class="mt-4 mb-4">choose Access</h5>
					<div class="row mb-5">					
						<div class="col-md-2 col-sm-2 col-12 access-section text-center permission activeper" data-id='1'>
						<div class="icon-img"><img src="/svg/Permissions.svg"></div>
						<span>PERMISSIONS</span>
						</div>						
						<div class="col-md-2 col-sm-2 col-12 access-section text-center permission" data-id='3'>
						<div class="icon-img"><img src="/svg/institutes.svg"></div>
						<span>INSTITUTES</span>
						</div>
						<div class="col-md-2 col-sm-2 col-12 access-section text-center permission" data-id='2'>
						<div class="icon-img"><img src="/svg/recruiters.svg"></div>
						<span>RECRUITERS</span>
						</div>
						<div class="col-md-2 col-sm-2 col-12 access-section text-center permission" data-id='5'>
						<div class="icon-img"><img src="/svg/inbox.svg">	</div>
						<span>INBOX</span>
						</div>
						<div class="col-md-2 col-sm-2 col-12 access-section text-center permission" data-id='6'>
						<div class="icon-img"><img src="/svg/payment.svg"></div>
						<span>PAYMENT</span>
						</div>
						<div class="col-md-2 col-sm-2 col-12 access-section text-center permission" data-id='7'>
						<div class="icon-img"><img src="/svg/payment.svg"></div>
						<span>Students</span>
						</div>
					</div>
					
				<h5>Add heading</h5>
				<div class="input-group mb-4 w-50"> 
				  <input type="hidden"  class="form-control id" name="id" placeholder="">
				  <input type="hidden"  class="form-control user_access" name="user_access" placeholder=" Enter user_access"  value='1'>
				  <input type="hidden"  class="form-control user_group_id" name="user_group_id" placeholder=" "  value='3'>
				  <input type="text" class="form-control heading" name="heading" placeholder="Enter Heading" required>
				</div>	
				<div class="row">
				<div class="col-12 col-md-6 mt-2">
				<h6>add superviser</h6>
				<div class="col-10 px-0">
				
						<select class="form-control supervisor_id checksame" id="supervisor_id" name="supervisor_id" required>
							<option value="" >Please select</option>
							
							@foreach($result['account_types'] as $value)
							<option value="{{ $value->id }}">
							{{ $value->usergroup_name }}
							</option>
							@endforeach
							</select>
                        </div>
				
				</div>
				<div class="col-12 col-md-6 mt-2">
				<h6>add subordinate</h6>
				<div class="col-10 px-0">
						<select class="form-control subordinate_id checksame" id="subordinate_id" name="subordinate_id" required data-parsley-required data-parsley-notequalto="#supervisor_id" data-parsley-notequalto-message="These two fields must not be identical!">
							<option value="">Please select</option>
							@foreach($result['account_types'] as $value)
							<option value="{{ $value->id }}">
							{{ $value->usergroup_name }}
							</option>
							@endforeach
							</select>
                        </div>
						<span class='notequalto'> Supervisor and subordinate should not be same </span>
				
				</div>
				</div>
				
				<div class="text-right mt-4 col-11">
				<button  type="button" class="btn btn-primary save_permission">save</button></div>																				
				
				</div>
				</form>
            </div>
		
		
		<div class="modal fade" id="addgroup" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>					
                    <div class="modal-body">                       
						<div class="thank-you-pop">						
						<div class="card">
							<div class="card-header"><strong>Admin user Group </strong></div>
							<form action='#' class="usergroup_form" method="post" >
							{{ csrf_field() }}
							<div class="card-body">
							<div class="form-group">
							<label for="nf-password" class='label_value'>Group name</label>
							<input class="form-control group_name" id="inputfield" type="text" name="group_name" autocomplete="off" required>
							<span id="errmsg"></span>
							</div>
							</div>
							</form>
							<div class="card-footer text-center">
							<button class="btn btn-sm btn-primary add_usergroup" type="button">Save </button>
							</div>
							</div>
 						</div>                         
                    </div>					
                </div>
            </div>
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

<script  src="/js/parsley.min.js" defer ></script>
<script  src="/js/parsley.js" defer></script>
<script  src="/js/jquery.min.js"></script>
	<script>
$( document ).ready(function() {
//$('a.admingroup:eq(2)').css("background-color", "#49a4fd");
$('a.admingroup:eq(2)').addClass("activetab");
$('.notequalto').css('display','none');
$(".save_permission").click(function(e)
	{		
        e.preventDefault();
        
		var form = $(".permission_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			var supervisor_id = $('.supervisor_id').val();
			var subordinate_id = $('.subordinate_id').val();
			if((supervisor_id !='') & (subordinate_id !=''))
			{
				if(supervisor_id == subordinate_id)
				{
					$('.notequalto').css('display','block');
					return false;
				}
			}
			
			    var save_url="{{ url('admin/save_permission') }}";
				var formdata = $(".permission_form").serialize();
					$.ajax({
					type:'POST',
					url:save_url,
					data:formdata,
					success:function(data)
					{
							swal({
							title: "",
							text: data.message,
							type: "success"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('admin/adminpermissions') }}";
							window.location.href=url;
						   }, 2000);
					}, error:function (error) {
				    var errorResponse = JSON.parse(error.responseText);
                    swal({
                        title: "",
                        text: errorResponse.message,
                        type: "error"
                    });

                    setTimeout(function(){
                        var url ="{{ url('admin/adminpermissions') }}";
                        window.location.href=url;
                    }, 2000);
                }


					});	
			
		}
				
	});
	$(".add_usergroup").click(function(e)
	{		
        e.preventDefault();
        
		var form = $(".usergroup_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{
			
			    var save_url="{{ url('admin/save_usergroup') }}";
				var formdata = $(".usergroup_form").serialize();
					$.ajax({
					type:'POST',
					url:save_url,
					data:formdata,
					success:function(data)
					{
							swal({
							title: "",
							text: data.message,
							type: "success"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('admin/adminpermissions') }}";
							window.location.href=url;
						   }, 2000);

					}, error:function (error) {
				    var errorResponse = JSON.parse(error.responseText);
                    swal({
                        title: "",
                        text: errorResponse.message,
                        type: "error"
                    });

                    setTimeout(function(){
                        var url ="{{ url('admin/adminpermissions') }}";
                        window.location.href=url;
                    }, 2000);
                }

					});	
			
		}
				
	});

$(".checksame").change(function(e)
{	
	$('.notequalto').css('display','none');
	var supervisor_id = $('.supervisor_id').val();
	var subordinate_id = $('.subordinate_id').val();
	if((supervisor_id !='') & (subordinate_id !=''))
	{
		if(supervisor_id == subordinate_id)
		{
			$('.notequalto').css('display','block');
			return false;
		}
	}
});

$(".permission").click(function(e)	
{
	//$("div.permission").css("background-color", "#FFF");
	//$(this).css("background-color", "#49a4fd");
	$("div.permission").removeClass("activeper");
	$(this).addClass("activeper");

	var permission_id = $(this).attr('data-id');
	$('.user_access').val(permission_id);	
	
	
});	

$(".admingroup").click(function(e)	
{
	//$(".admingroup").css("background-color", "#FFF");
	//$(this).css("background-color", "#49a4fd");

	$(".admingroup").removeClass("activetab");
	$(this).addClass("activetab");
	var permission_id = $(this).attr('data-id');
	$('.user_group_id').val(permission_id);	
	
	
		var id = $(this).attr('data-id');
		var geturl ="{{ url('admin/getadminpermission') }}";
		$.ajax({
		type:'POST',
		url:geturl,
		data:{id:id},
		success:function(data)
		{
			if(data.status_code =='200')
			{		
				$('.heading').val(data.permission.heading);
				$('.supervisor_id').val(data.permission.supervisor_id);
				$('.subordinate_id').val(data.permission.subordinate_id).change();
				$('.user_access').val(data.permission.user_access);
				//$('.user_group_id').val(data.permission.user_group_id);
				$('.id').val(data.permission.id);				
				$("div.permission").removeClass("activeper");
				$( "div.permission[data-id*='"+data.permission.user_access+"']" ).addClass("activeper");
								
			}
			else
			{
				$('.heading').val('');
				$('.supervisor_id').val('');
				$('.subordinate_id').val('').change();
				$('.user_access').val('');
				//$('.user_group_id').val('');
				$('.id').val('');				
				$("div.permission").removeClass("activeper");
				$( "div.permission[data-id*='1']" ).addClass("activeper");
						
			}

		}

		});	
	
	
	
});	


var id = "{{ Session::get('user')->account_type }}";
		var geturl ="{{ url('admin/getadminpermission') }}";
		$.ajax({
		type:'POST',
		url:geturl,
		data:{id:id},
		success:function(data)
		{
			if(data.status_code =='200')
			{		
				$('.heading').val(data.permission.heading);
				$('.supervisor_id').val(data.permission.supervisor_id);
				$('.subordinate_id').val(data.permission.subordinate_id).change();
				$('.user_access').val(data.permission.user_access);
				$('.user_group_id').val(data.permission.user_group_id);
				$('.id').val(data.permission.id);				
				$("div.permission").removeClass("activeper");
				$( "div.permission[data-id*='"+data.permission.user_access+"']" ).addClass("activeper");
				$(".admingroup").removeClass("activetab");
				$( "a.admingroup[data-id='"+data.permission.user_group_id+"']" ).addClass("activetab");				
			}
			else
			{
				$('.heading').val('');
				$('.supervisor_id').val('');
				$('.subordinate_id').val('').change();
				$('.user_access').val('');
				$('.user_group_id').val('');
				$('.id').val('');				
				$("div.permission").removeClass("activeper");
				$( "div.permission[data-id*='1']" ).addClass("activeper");
						
			}

		}

		});	
		
});
</script>

