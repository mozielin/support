@extends('layouts.master')
@section('title')
<h2 style="margin-top: 2px;">Role列表</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.user_center_block')
</div>
<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;display:flex;justify-content:center;text-align:center;"><!--東西置中-->
		<!--左邊的搜尋區塊-->
		<div class="left-side" style="width:360px;height:57px;float:right;display:flex;justify-content:center;text-align:center;margin-top:3px;">
			<form class="form-horizontal" method="POST" action="{{ route('company_industry_store') }}">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('company_industry_name') ? ' has-error' : '' }}">
					<input id="company_industry_name" type="text" class="form-control" name="company_industry_name" value="{{ old('company_industry_name') }}" placeholder="請輸入ip" required autofocus style="width:240px;float:left;margin-right:10px;"></input>
				</div>
			</form>
		</div>
		@if ($errors->any())
		<div class="alert alert-danger" style="height:52px;position:absolute;right:781px;top:300px;">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<!--右邊的新增區塊-->
		<div class="right-side" style="width:360px;height:57px;margin-top:3px;">
			<button type="button" style="float:right;" class="btn btn-primary" onclick="location.href='{{route('role_create')}}'"><i class="glyphicon glyphicon-plus"></i> 新增Role </button>
		</div>
		<!--中間的線-->
		<div class="line" style="height:30px;border-right:1px solid #D3E0E9;position:absolute;left:783px;top:167px;">
		</div>
	</div>
</div>
</div>
<div class="container" style="width:780px;height:100%;margin-right:218px;">
<div class="panel panel-default">
	<div class="panel-heading" style="height:100%;">
		<div class="row" style="text-align:center;"">
			<div class="col-md-1" style="border-right:1px solid black;">
				<span>ID</span>
			</div>
			<div class="col-md-2" style="border-right:1px solid black;">
				<span>RoleName</span>
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				<span>DisplayName</span>
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				<span>Description</span>
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				<span>更新時間</span>
			</div>
		</div>
	</div>
</div>
</div>
<div class="container" style="width:780px;min-height:250px;height:100%;margin-right:218px;">
@foreach($data as $server)
<div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('role_view', $server->id)}}'">
	<div class="panel-heading" style="height:100%;">
		<div class="row" style="text-align:center;">
			<div class="col-md-1 " style="border-right:1px solid black;">
				{{$server->id}}
			</div>
			<div class="col-md-2" style="border-right:1px solid black;">
				{{$server->name}}
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				{{$server->display_name}}
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				{{$server->description}}
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				{{$server->updated_at}}
			</div>
			
		</div>
	</div>
</div>

@endforeach

<div class="panel-heading" style="height:30px; display:flex; justify-content:center;align-items:center;">
	{{$data->links()}}
</div>
</div>
@endsection