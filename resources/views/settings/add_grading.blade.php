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

</style>
  <div class="container add-grading-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
            <div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn header" href="{{ url('account') }}">Account</a>
					<a class="select-btn header" href="{{ url('system') }}">System</a>
					<a class="select-btn header active" href="{{ url('grading') }}">Grading</a>
					<a class="select-btn header" href="{{ url('educationlevel') }}">Education level</a>
			</div>
			
			<div class="col-md-12 col-12 ">
			<form action='#' class="save_grading_form" method="post" >
			<input type="hidden" name='id' class='id' value="" />
				{{ csrf_field() }}
            <div class="col-md-12 adding-grade col-12 row mt-5">
				<div class="col-lg-7 col-12">
				 <div class="col-12 mb-3">
					<label class="col-12">Country  </label>
					<div class="btn-group row mx-0 ml-2">
                          <select class="form-control country_id" id="country_id" name="country_id" required>
							<option value="0">Please select</option>
							@foreach($result['country'] as $value)
							 <option value="{{ $value->id }}">{{ $value->country_name }}</option>
						 @endforeach
							</select>
                    </div>

                </div>
				<!--<div class="col-12 mb-3">

				<label class="col-12">Country  </label>
				<!--multiselect dropdown

				<div class="multiselect ml-2" id="countries" multiple="multiple" data-target="multi-0">
				<div class="title noselect">
					<span class="text">please Select</span>
					<span class="close-icon">&times;</span>
					<span class="expand-icon">&plus;</span>
				</div>
				<div class="container p-0">
										@foreach($result['country'] as $value)
										<option value="{{ $value->country_name }}">{{ $value->country_name }}</option>
									@endforeach
				</div>
			</div>
			<!--multiselect dropdown end-here
			</div>-->


				<div class="col-12 mb-3">
					<label class="col-12">Education Level </label>
					<div class="btn-group row mx-0 ml-2">
                         <select class="form-control educationlevel_id" id="educationlevel_id" name="educationlevel_id" required>
							<option value="">select Education level</option>
							</select>
                    </div>
                </div>
				<div class="col-12 mb-3">
					<label class="col-12">Title </label>
					<div class="btn-group row mx-0 ml-2">
                           <input class="form-control grading_scheme" id="grading_scheme" type="text" name="grading_scheme"  required>
                    </div>
                </div>
				
				<div class="col-12 ml-2 mb-3">
				<label class="col-12 pl-0 d-inline">Status </label>
					<div class="custom-control custom-switch d-inline">
				  <input type="checkbox" class="custom-control-input status" id="customSwitch1" name='status'>
				  <label class="custom-control-label" for="customSwitch1"></label>
				</div>
                </div>
				<div class="col-12 ml-2 mb-3">
				<label class="col-12 pl-0 d-inline">Range </label>
					<div class="custom-control custom-switch d-inline">
				  <input type="checkbox" class="custom-control-input gradingvalue" id="gradeswitch" name='gradingvalue'>
				  <label class="custom-control-label" for="gradeswitch"></label>
				</div>
                </div>
				
				<div class="col-12 mb-6 grads" style="display:none">
				<table width="80%" border="0" cellspacing="0" cellpadding="5"  >
				<tr class='lines_heading'>
						<td>Min</td><td><input class=" form-control minvalue" id="minvalue" type="text" name="minvalue"></td>
						<td>Max</td><td><input class=" form-control maxvalue" id="maxvalue" type="text" name="maxvalue"></td>
						<td> </td>
					</tr>
				</table>
				</div>
				
				<div class="col-12 mb-6 percent">				
					<table width="100%" border="0" cellspacing="0" cellpadding="5"  id="table-data">
					<tr class='lines_heading'>
						<td>Grade Label</td>
						<td>Grade Range</td>
						<td> </td>
					</tr>
					<tr class="tr_clone">
						<td width="70px">
						<input class=" form-control grade_label" id="grade_label" type="text" name="grade_label[]" required>
						<td>
						<select class="form-control" id="grade_range" name="grade_range[]" required>
						<option value="">Select level</option>
						@foreach($result['grading_range'] as $value)
						<option value="{{ $value }}">
						{{ $value }}
						</option>
						@endforeach
						</select>
						</td>
						
						
						
						
						
						<td>
						
						</td>
						
						
						
						
						<td><img class="tr_clone_add" src="img/add.png" style="width:20px"></img></td>
						<td><img class="tr_clone_remove" src="img/remove.png" style="width:20px"></img></td>
					</tr>
					</table>
				</div><br>			
				
				
				
				<div class="col-12 text-right pr-0 mb-3">
					<button class="btn btn-sm btn-primary save_grading" type="button">Save</button>
				</div>
				
				</div>
				<div class="col-lg-5 col-12" style="border-left:1px solid" >
				<div class="col-12 countrygrade">
				@foreach($result['grading'] as $value)
					 <div class="edit_grading" id="{{ $value->id }}" style="padding:6px">{{ $value->grading_scheme }}</div>
				@endforeach
                </div>
				<div class="col-12 mt-5">
					<button  class="btn btn-sm btn-primary " type="button"><a  href="{{ url('add_grading') }}" style="text-decoration:none;color:#FFF"> Add Subsection</button>
				</div>
				</div>
				</div>
				

			</form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
<script  src="{{ url('js/parsley.min.js') }}" defer></script>
<script  src="{{ url('js/parsley.js') }}" defer></script>
<script  src="{{ url('js/jquery.min.js') }}"></script>
<script>

{/*multiselect dropdown*/}
Array.prototype.search = function(elem) {
    for(var i = 0; i < this.length; i++) {
        if(this[i] == elem) return i;
    }
    
    return -1;
};

var Multiselect = function(selector) {
    if(!$(selector)) {
        console.error("ERROR: Element %s does not exist.", selector);
        return;
    }

    this.selector = selector;
    this.selections = [];

    (function(that) {
        that.events();
    })(this);
};

Multiselect.prototype = {
    open: function(that) {
        var target = $(that).parent().attr("data-target");

        // If we are not keeping track of this one's entries, then
        // start doing so.
        if(!this.selections) {
            this.selections = [ ];
        }

        $(this.selector + ".multiselect").toggleClass("active");
    },

    close: function() {
        $(this.selector + ".multiselect").removeClass("active");
    },

    events: function() {
        var that = this;

        $(document).on("click", that.selector + ".multiselect > .title", function(e) {
            if(e.target.className.indexOf("close-icon") < 0) {
                that.open();
            }
        });

        $(document).on("click", that.selector + ".multiselect option", function(e) {
            var selection = $(this).attr("value");
            var target = $(this).parent().parent().attr("data-target");

            var io = that.selections.search(selection);

            if(io < 0) that.selections.push(selection);
            else that.selections.splice(io, 1);

            that.selectionStatus();
            that.setSelectionsString();
        });

        $(document).on("click", that.selector + ".multiselect > .title > .close-icon", function(e) {
            that.clearSelections();
        });

        $(document).click(function(e) {
            if(e.target.className.indexOf("title") < 0) {
                if(e.target.className.indexOf("text") < 0) {
                    if(e.target.className.indexOf("-icon") < 0) {
                        if(e.target.className.indexOf("selected") < 0 ||
                           e.target.localName != "option") {
                            that.close();
                        }
                    }
                }
            }
        });
    },

    selectionStatus: function() {
        var obj = $(this.selector + ".multiselect");

        if(this.selections.length) obj.addClass("selection");
        else obj.removeClass("selection");
    },

    clearSelections: function() {
        this.selections = [];
        this.selectionStatus();
        this.setSelectionsString();
    },

    getSelections: function() {
        return this.selections;
    },

    setSelectionsString: function() {
        var selects = this.getSelectionsString().split(", ");
        $(this.selector + ".multiselect > .title").attr("title", selects);

        var opts = $(this.selector + ".multiselect option");

        if(selects.length > 6) {
            var _selects = this.getSelectionsString().split(", ");
            _selects = _selects.splice(0, 6);
            $(this.selector + ".multiselect > .title > .text")
                .text(_selects + " [...]");
        }
        else {
            $(this.selector + ".multiselect > .title > .text")
                .text(selects);
        }

        for(var i = 0; i < opts.length; i++) {
            $(opts[i]).removeClass("selected");
        }

        for(var j = 0; j < selects.length; j++) {
            var select = selects[j];

            for(var i = 0; i < opts.length; i++) {
                if($(opts[i]).attr("value") == select) {
                    $(opts[i]).addClass("selected");
                    break;
                }
            }
        }
    },

    getSelectionsString: function() {
        if(this.selections.length > 0)
            return this.selections.join(", ");
        else return "Select";
    },

    setSelections: function(arr) {
        if(!arr[0]) {
            error("ERROR: This does not look like an array.");
            return;
        }

        this.selections = arr;
        this.selectionStatus();
        this.setSelectionsString();
    },
};

$(document).ready(function() {
    var multi = new Multiselect("#countries");
});

{/*multiselect dropdown ends here*/}

$( document ).ready(function() 
{
	
	

    $('#gradeswitch').change(function() {
        if(this.checked) {
			$(".grads").show();
			$(".percent").hide();
        }else{
			$(".grads").hide();
			$(".percent").show();
		}
        
    });
	
	
	
	
$(".save_grading").click(function(e)
	{		
        e.preventDefault();
		var form = $(".save_grading_form");
		form.parsley().validate();
		if(form.parsley().isValid())
		{

			    var save_url = "{{ url('save_grading') }}";
				var formdata = $(".save_grading_form").serialize();
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
							var url ="{{ url('add_grading') }}";
							window.location.href=url;
						   }, 1000);
						}
						else
						{
							swal({
							title: "",
							text: response.message,
							type: "error"
						   });
						   setTimeout(function(){ 
							var url ="{{ url('add_grading') }}";
							window.location.href=url;
						   }, 1000);		
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
			
			var geturl ="{{ url('getcoungtrybasededulevel') }}";
			$.ajax({
			type:'POST',
			url:geturl,
			data:{country_id:country_id},
			success:function(data)
			{
				
				if(data.status_code =='200')
				{
					
				  $('.educationlevel_id').find('option').not(':first').remove();	
				  $('.educationlevel_id').append(data.options);	
				}
				else
				{
				$('.educationlevel_id').find('option').not(':first').remove();				
				}

			}

			});	
			var geturl ="{{ url('getcountrybasedgrade') }}";
			$.ajax({
			type:'POST',
			url:geturl,
			data:{country_id:country_id},
			success:function(data)
			{
				
				if(data.status_code =='200')
				{
					$('.edit_grading').html(''); 
				
				  $('.countrygrade').html(data.options);	
				}
				else
				{
					$('.edit_grading').html(''); 			
				}

			}

			});	
			
		}
		
	});



$(document).on("click",".edit_grading",function() 

{
	
		var id = $(this).attr('id');	
		var geturl ="{{ url('edit_grading') }}";
		$.ajax({
		type:'POST',
		url:geturl,
		data:{id:id},
		success:function(data)
		{
			//var response = JSON.parse(data);
			
			if(data.status_code =='200')
			{console.log(data.grading);
			  $('.grading_scheme').val(data.grading.grading_scheme);
			  $('.id').val(data.grading.id);
			  $('.country_id').val(data.grading.country_id).change();
			  if(data.grading.status =="1")
			  {
				 $('.status').prop( "checked", true );
			  }else{
				  $('.status').prop( "checked", false ); 
			  }
			  if(data.grading.grading =="1")
			  {
				 $('.gradingvalue').prop( "checked", true );
				 $(".grads").show();
				 $(".percent").hide();
				 $('.minvalue').val(data.grading.minimum);
				 $('.maxvalue').val(data.grading.maximum);
			  }else{
				   $('.gradingvalue').prop( "checked", false );
				   $(".grads").hide();
				   $(".percent").show();
			  }
			  setTimeout(function(){ 
			  $('.educationlevel_id').val(data.grading.educationlevel_id).change();
			  }, 1000);
			  $('tr.tr_clone').remove();
			  $(data.linecontent).insertAfter("#table-data tr:first");
			}
			else
			{
						
			}

		}

		});	
});	



	
$(document).on("click",".tr_clone_add",function() 
{
    var $tr    = $(this).closest('tr');
    var $clone = $tr.clone();
    $clone.find(':text').val('');
    //$tr.after($clone);
	
	$($clone).insertAfter("tr:last");
});	

$(document).on("click",".tr_clone_remove",function() 
{
	var rowCount = $('#table-data tr').length;
	if(rowCount >2)
	{
	$(this).closest('tr').remove();
	}
	
});
	
});
</script>
