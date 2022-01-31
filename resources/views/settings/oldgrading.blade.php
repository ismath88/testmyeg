@extends('layouts.app')

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
			
			<div class="col-md-11 col-12 ">
			<div class="col-md-12 d-flex col-12">
					<button class="btn btn-block btn-primary" type="button">Add More</button>
					<button class="btn btn-block btn-primary" type="button">Upload CSV</button>
			</div>
            <div class="col-md-10 col-12 ml-5 mt-5">
				<div class="">
					<div class="card-body">
						<table class="table table-responsive-sm">
						<thead>
						<tr>
						<th>Id</th>
						<th>Country</th>
						<th>Education Level</th>
						<th>Grading Scheme</th>
						<th>Status</th>
						<th>Edit</th>
						<th>Delete</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td>Samppa Nori</td>
						<td>2012/01/01</td>
						<td>Member</td>
						<td><span class="badge badge-success">Active</span></td>
						</tr>
						<tr>
						<td>Estavan Lykos</td>
						<td>2012/02/01</td>
						<td>Staff</td>
						<td><span class="badge badge-danger">Banned</span></td>
						</tr>
						<tr>
						<td>Chetan Mohamed</td>
						<td>2012/02/01</td>
						<td>Admin</td>
						<td><span class="badge badge-secondary">Inactive</span></td>
						</tr>
						<tr>
						<td>Derick Maximinus</td>
						<td>2012/03/01</td>
						<td>Member</td>
						<td><span class="badge badge-warning">Pending</span></td>
						</tr>
						<tr>
						<td>Friderik Dávid</td>
						<td>2012/01/21</td>
						<td>Staff</td>
						<td><span class="badge badge-success">Active</span></td>
						</tr>
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
