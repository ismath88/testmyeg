
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
		</li>

		
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="/svg/setting.svg" alt="" class="" width="">
			</svg> SETTINGS</a>

			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('account') }}"> Account</a>
				</li>

				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('system') }}"> System</a>
				</li>

				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('grading') }}"> Grading</a>
				</li>

				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('educationlevel') }}"> Education Level</a>
				</li>

			</ul>
		</li>
		
        @if(Session::get('permission')->user_access =="1")
		<li class="c-sidebar-nav-dropdown"><a class=" c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/Permissions.svg') }}" alt="" class="" width="">
			</svg> PERMISSIONS</a>

			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('adminpermissions') }}"> Admin Permissions</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('manage_invites') }}">Invite Admin Users</a>
				</li>

				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('adminpersonnel') }}"> Admin Personnel</a>
				</li>

			</ul>
		</li>
		@endif
		
	@if(Session::get('permission')->user_access =="3")
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/institutes.svg') }}" alt="" class="" width="">
			</svg> INSTITUTES</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('universities') }}"> Universities</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('university-pendinginvites') }}"> Pending Invites</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('universities-blocked') }}"> Blocked Institutes</a>
				</li>
			</ul>
		</li>
		@endif

		<li class="c-sidebar-nav-divider"></li>
@if(Session::get('permission')->user_access =="2")
		
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/recruiters.svg') }}" alt="" class="" width="">
			</svg> RECRUITERS</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="javascript:void(0);"> List</a>
				</li>
			</ul>
		</li>
		@endif
		
		

		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/students.svg') }}" alt="" class="" width="">
			</svg> STUDENTS</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="javascript:void(0);"> List</a>
				</li>
			</ul>
		</li>

@if(Session::get('permission')->user_access =="5")
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/inbox.svg') }}" alt="" class="" width="">
			</svg> INBOX</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="javascript:void(0);"> List</a>
				</li>
			</ul>
		</li>
		@endif

@if(Session::get('permission')->user_access =="6")
		<li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="javascript:void(0);">
			<svg class="c-sidebar-nav-icon">
			<img src="{{ url('/svg/payment.svg') }}" alt="" class="" width="">
			</svg> PAYMENT</a>
			<ul class="c-sidebar-nav-dropdown-items">
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('paymentdetails') }}"> Payment Details</a>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ url('paypaldetails') }}"> Paypal Details</a>
				</li>
			</ul>
		</li>
@endif
		

	
	</ul>
	<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-unfoldable"></button>

</div>

