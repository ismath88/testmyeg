@extends('layouts.app')

@section('content')
  <div class="container-fluid">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
			<div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn">Account</a>
					<a class="select-btn">System</a>
					<a class="select-btn active">Grading</a>
					<a class="select-btn">Education level</a>
			</div>
			
			<div class="col-md-11 col-12 ">
			<div class="col-md-12 text-right mt-3 col-12">
				<button class="btn btn-primary" type="button">Add More</button>
				<button class="btn btn-primary" type="button">Upload CSV</button>
			</div>
            <div class="col-md-10 col-12 ml-5 mt-5">
				<div class="">
					<div class="card-body">
						<table class="table table-responsive-sm">
						<thead>
						<tr>
						<th>S.NO</th>
						<th>Education Level</th>
						<th>Main Level</th>
						</tr>
						</thead>
						<tbody>
						@if(count($result['educationlevellevel']) > 0)
						@foreach($result['educationlevellevel'] as $key=>$value)
						 <tr>    
							  <td>{{ ($key + 1)}}</td>                  
							  <td>{{$value->educationlevel_name}}</td>               
							  <td>{{$value->level_name}}</td>                    
							</tr>
						@endforeach
						@else
							<tr>    
							  <td colspan='5' align="center"> No Record found</td>                   
							</tr>
						@endif
						</tbody>
						</table>
						<ul class="pagination">
						<li class="page-item"><a class="page-link" href="#">Prev</a></li>
						<li class="page-item active"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">4</a></li>
						<li class="page-item"><a class="page-link" href="#">Next</a></li>
						</ul>
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
