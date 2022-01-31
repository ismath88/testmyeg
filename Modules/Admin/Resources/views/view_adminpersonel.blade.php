@extends('layouts.app')

@section('content')
<style>
</style>
  <div class="container-fluid">
        <div class="fade-in mb-5">
		<div class="container">
		<!-- row1 data-->
			<div class="col-12 col-xl-8 pb-3 border-bottom">
			<div class="row pt-3">
			@if(count($result['invites']) > 0)
			@foreach($result['invites'] as $key=>$value)
			<div class="col-6 col-xl-4">
			<a href ="{{ url('admin/edit_adminpersonnel/'.$value->id) }}" ><img src='/img/edit.png' width="20" align ="right"></a>
			<div class="row pr-md-3 pr-0">
			<h6 class="w-100">{{$value->usergroup_name}}</h6 >
			<div class="input-group mb-3">
				<p class="w-100 mb-0">name</p>
				<input type="text" class="form-control" placeholder="Ken Burns"  value="{{$value->name}}" readonly='readonly'>
				<p class="w-100 mb-0">Email</p>
				<input type="text" class="form-control" placeholder="info@deakin.com" value="{{$value->email}}" readonly='readonly'>
			</div>
			</div>
			</div>
			@endforeach
			@else
				
			@endif
			
			
			</div>
			</div>
			</div>
		
	</div>
    </div>
@endsection

