<@extends('layouts.app')

@section('content')
  <div class="container grading-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
            <div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn">Account</a>
					<a class="select-btn">System</a>
					<a class="select-btn active">Grading</a>
					<a class="select-btn">Education level</a>
			</div>
			
			<div class="col-lg-11 col-12 ">
			<div class="col-md-12 d-flex col-12">
					<button class="btn btn-block btn-primary" type="button">Add More</button>
					<button class="btn btn-block btn-primary" type="button">Upload CSV</button>
			</div>
            <div class="col-lg-10 col-12 ml-5 mt-5">
				<div class="">
					<div class="card-body">
						<table class="table table-responsive-sm">
						<thead>
						<tr>
						<th>Idd</th>
						<th>Country</th>
						<th>Education Level</th>
						<th>Grading Scheme</th>
						<th>Status</th>
						</tr>
						</thead>
						<tbody>
						@if(count($result['grading']) > 0)
						@foreach($result['grading'] as $key=>$value)
						 <tr>    
							  <td>{{ ($key + 1)}}</td>                  
							  <td>{{$value->country_name}}</td>               
							  <td>{{$value->educationlevel_name}}</td>               
							  <td>{{$value->grading_scheme}}</td>               
							  <td>{{$value->status}}</td>                     
							</tr>
						@endforeach
						@else
							<tr>    
							  <td colspan='5' align="center"> No Record found</td>                   
							</tr>
						@endif
						</tbody>
						</table >
						
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
