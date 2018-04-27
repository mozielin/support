@extends('layouts.master')

@section('title')
	<h2 style="margin-top: 2px;">如有疑問請跟PETER聯繫</h2>
@endsection

@section('contentm')



	@if (Session::has('flash_message'))
		<div class="alert alert-danger" style="width:600px;height:300px;text-align:center;margin-left:500px;">
			{{ Session::get('flash_message') }}
		</div>
	@endif

@endsection