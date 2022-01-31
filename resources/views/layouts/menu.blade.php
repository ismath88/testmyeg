
	<div class="c-sidebar-brand d-md-down-none">
		<!--<svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
			<use xlink:href="assets/brand/coreui-pro.svg#full"></use>
		</svg>

		<svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
			<use xlink:href="assets/brand/coreui-pro.svg#signet"></use>
		</svg> -->
		<a href="{{ url('home') }}">
		<img src="{{ url('/img/formee_logo_white.svg') }}" alt="" class="" width="184">
		</a>
	</div>

	<ul class="c-sidebar-nav">
		<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('home') }}">		
			<svg class="c-sidebar-nav-icon">
				<img src="{{ url('/svg/home.svg') }}" alt="" class="" width="">
			</svg>DASHBOARD</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/performanceapplication') }}"> Overview</a>
				</li>
			</ul>
		</li>
		
		
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="/svg/setting.svg" alt="" class="" width="">
			</svg> SETTINGS</a>

			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('account') }}"> Account</a>
				</li>
				@if((Session::get('user')->account_type =="3"))
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('system') }}"> System</a>
				</li>

				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('grading') }}"> Grading</a>
				</li>

				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('educationlevel') }}"> Education Level</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('adminfaqlist') }}"> FAQ</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('admincmslist') }}"> CMS</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('listnews') }}"> News</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('education_partner') }}"> Education Partner</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('testimonial') }}"> Testimonial</a>
				</li>
@endif

			</ul>
		</li>
		
        @if((Session::get('permission')->user_access =="1") || (Session::get('user')->account_type =="3"))
		<li class="c-sidebar-nav-dropdown"><a class=" c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/Permissions.svg') }}" alt="" class="" width="">
			</svg> PERMISSIONS</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('admin/adminpermissions') }}"> Admin Permissions</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('admin/manage_invites') }}">Invite Admin Users</a>
				</li>

				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('admin/adminpersonnel') }}"> Admin Personnel</a>
				</li>

			</ul>
		</li>
		@endif
		
	@if((Session::get('permission')->user_access =="3") || (Session::get('user')->account_type =="3"))
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/institutes.svg') }}" alt="" class="" width="">
			</svg> INSTITUTES</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/universities') }}"> Universities</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/university-pendinginvites') }}"> Pending Invites</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/universities-blocked') }}"> Blocked Institutes</a>
				</li>
				 <li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/ranking/0-0-0') }}"> Institute Ranking</a>
				</li>
			</ul>
		</li>
		@endif

		
@if((Session::get('permission')->user_access =="2") || (Session::get('user')->account_type =="3"))
		
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/recruiters.svg') }}" alt="" class="" width="">
			</svg> RECRUITERS</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('recruiter/recruiters') }}"> recruiters</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('recruiter/recruiter-pendinginvites') }}"> Pending Invites</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('recruiter/recruiter-blocked') }}"> Blocked Recruiters</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/recruitersranking/0-0') }}"> Recruiters Ranking</a>
				</li>
			</ul>
		</li>
		@endif
	<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link" href="{{ url('saleslead/All/0') }}">
		<svg class="c-sidebar-nav-icon">
		<img src="{{ url('/svg/Permissions.svg') }}" alt="" class="" width="">
		</svg> Sales leads</a>
		
	</li>
@if((Session::get('permission')->user_access =="7") || (Session::get('user')->account_type =="3"))		
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/students.svg') }}" alt="" class="" width="">
			</svg> STUDENTS</a>
			<ul class="c-sidebar-nav-dropdown-items">
			<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('student/newApplication/0-0') }}"> Admissions</a>
					<a class="c-sidebar-nav-link" href="{{ url('student/getStudentLibrary') }}"> Student Library</a>
					<a class="c-sidebar-nav-link" href="{{ url('university/activeRules') }}">Manage Applications</a>
				</li>
				
			
			</ul>
		</li>
@endif

	@if((Session::get('user')->account_type =="3"))		
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/students.svg') }}" alt="" class="" width="">
			</svg> LIBRARY</a>
			<ul class="c-sidebar-nav-dropdown-items">
			<li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="{{ route('admin-courses-list') }}">All Courses</a>
			</li>		
		</ul>
	</li>
	@endif
	
@if((Session::get('permission')->user_access =="5") || (Session::get('user')->account_type =="3"))
		<li class="c-sidebar-nav-dropdown showtab"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			 <img src="{{ url('/svg/inbox.svg') }}" alt="" class="" width="">
			</svg> MAIL</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="/student/getStudentinbox/<?php echo Session::get('user')->id; ?>/Admin?filter=0"> Inbox</a>
					<a class="c-sidebar-nav-link" href="/student/pendinginvites"> Invitations</a>
					<a class="c-sidebar-nav-link" href="/student/getComplaints/<?php echo Session::get('user')->id; ?>/Admin"> Complaints</a>
					<a class="c-sidebar-nav-link" href="/student/getReportsofabuse/<?php echo Session::get('user')->id; ?>/Admin"> Repots of abuse</a>
					<a class="c-sidebar-nav-link" href="/student/getFunctionalityerror/<?php echo Session::get('user')->id; ?>/Admin"> Functionality Error</a>
					<a class="c-sidebar-nav-link" href="/student/getBlockrequest/<?php echo Session::get('user')->id; ?>/Admin"> Block Requests</a>
				</li>
			</ul>
		</li>
		@endif
@if((Session::get('permission')->user_access =="6") || (Session::get('user')->account_type =="3"))
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/payment.svg') }}" alt="" class="" width="">
			</svg> PAYMENT</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('paymentdetails') }}"> Payment Details</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('pendingpayments') }}"> Pending Payment</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('paypaldetails') }}"> Paypal Details</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('studentpayments') }}"> Students Payment</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('agentPendingpayments') }}"> Agent Pending Payment</a>
				</li>
			</ul>
		</li>
@endif


<li class="c-sidebar-nav-dropdown"><a class=" c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/Permissions.svg') }}" alt="" class="" width="">
			</svg> GDS</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('student/admin_studentverification') }}"> Requests</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('student/verifydocument') }}"> Verified Documents</a>
				</li>
				<!-- <li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('admin_studentverificationverified') }}">Verified List</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('admin_studentverificationblocked') }}"> Blocked Lists</a>
				</li> -->
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('student/university_contacts') }}"> Universities Contacts</a>
				</li>

			</ul>
		</li>
		
		<li class="c-sidebar-nav-dropdown"><a class=" c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/Permissions.svg') }}" alt="" class="" width="">
			</svg> Overview</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/performanceapplication') }}"> Applications</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/performancestudent') }}">Student Enrollment</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university/salesandcommission') }}"> Sales and Commissions</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('createmeeting') }}">Create Event</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('overviewperformance') }}">Overview Performance</a>
				</li>
				<!-- <li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('overviewperformance1') }}">Overview Performance1</a>
				</li> -->
			</ul>
		</li>

	
	</ul>
	<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-unfoldable"></button>

</div>

