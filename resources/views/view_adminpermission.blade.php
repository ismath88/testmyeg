@extends('layouts.app')

@section('content')
  <div class="admin-permission">
        <div class="fade-in">
             <div class="row">
				<div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn">Admin Manager</a>
					<a class="select-btn">Moderater</a>
					<a class="select-btn active">Customer Service</a>
					<a class="select-btn">chat officer</a>
					<a class="select-btn">Add Group +</a>
				</div>
			
			<div class="container col-md-10 col-12 ">
            <div class="col-md-6 col-12 ml-5 mt-5">
				<h5 class="mt-4 mb-4">choose Access</h5>
					<div class="row mb-5">
						<div class="col-md-2 col-sm-2 col-12 access-section text-center">
						<div class="icon-img"><img src="svg/Permissions.svg"></div>			
						<span>PERMISSIONS</span>
						</div>
						<div class="col-md-2 col-sm-2 col-12 access-section text-center">
						<div class="icon-img"><img src="svg/institutes.svg"></div>				
						<span>INSTITUTES</span>
						</div>
						<div class="col-md-2 col-sm-2 col-12 access-section text-center">
						<div class="icon-img"><img src="svg/recruiters.svg"></div>				
						<span>RECRUITERS</span>  
						</div>
						<div class="col-md-2 col-sm-2 col-12 access-section text-center">
						<div class="icon-img"><img src="img/inbox-icon.svg">	</div>		
						<span>INBOX</span>
						</div>
						<div class="col-md-2 col-sm-2 col-12 access-section text-center">
						<div class="icon-img"><img src="svg/payment.svg"></div>
						<span>PAYMENT</span>
						</div>
					</div>
				<h5>Add heading</h5>
				<div class="input-group mb-4 w-50">
				  <input type="text" class="form-control" placeholder="Recipient's username">
				</div>	
				<div class="row">
				<div class="col-12 col-md-6 mt-2">
				<h6>add superviser</h6>
				<div class="col-10 px-0">
						<select class="form-control" id="select1" name="select1" >
							<option value="0">Please select</option>
							<option value="1">Option #1</option>
							<option value="2">Option #2</option>
							<option value="3">Option #3</option>
							</select>
                        </div>
				
				</div>
				<div class="col-12 col-md-6 mt-2">
				<h6>add subordinate</h6>
				<div class="col-10 px-0">
						<select class="form-control" id="select1" name="select1" >
							<option value="0">Please select</option>
							<option value="1">Option #1</option>
							<option value="2">Option #2</option>
							<option value="3">Option #3</option>
							</select>
                        </div>
				
				</div>
				</div>
				<div class="text-right mt-4 col-11">
				<button type="button" class="btn btn-primary">save</button></div>																				
				
				</div>
            </div>
        </div>
    </div>
</div>
@endsection

