@extends('layouts.app')

@section('content')
  <div class="container system-page">
        <div class="fade-in">
             <div class="row">
            <!-- START -->
            <div class="col-md-12 sub-header d-flex col-12">
					<a class="select-btn">Account</a>
					<a class="select-btn">System</a>
					<a class="select-btn active">Grading</a>
					<a class="select-btn">Education level</a>
				</div>
			
			<div class="col-md-10 col-12 ">
            <div class="col-md-7 col-12 ml-5 mt-5">
				<div class="row mb-2">
					<div class="col-7">
						Gold User Limit
                    </div>
					<div class="col-5">
						1000
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						plotinum User Limit
                    </div>
					<div class="col-5">
						10000
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						Top Agent Limit
                    </div>
					<div class="col-5">
						45
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						Top Agent Limit Time Days
                    </div>
					<div class="col-5">
						30
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						Commission %
                    </div>
					<div class="col-5">
						15
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						GST %
                    </div>
					<div class="col-5">
						10
                    </div>
                </div>
				<div class="row mb-2">
					<div class="col-7">
						Cut off Date for Invoice Days
                    </div>
					<div class="col-5">
						90
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
