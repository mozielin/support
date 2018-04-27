@extends('layouts.master')
@section('title')
<h2 style="margin-top: 2px;">使用者列表</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.user_center_block')
</div>
<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;display:flex;text-align:center;"><!--東西置中-->
		<!--左邊的搜尋區塊-->
		<div class="left-side" style="width:300px;height:57px;display:flex;justify-content:center;text-align:center;margin-top:3px;">	
					<div class="input-group" style="width:300px;">
						<input id="companysearch" type="text" class="form-control" name="companysearch" value="{{ old('companysearch') }}" placeholder="請輸入查詢內容" required autofocus style="width:240px;margin-left: 40px;">
						<div class="input-group-btn">
			        		<button class="btn btn-primary" id="searchBTN" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			      		</div>
				    </div>
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
		<div class="right-side" style="width:360px;height:57px;float:right;margin-top:3px;">
			@role('admin')
			<a href="{{route('user_create')}}"><button type="submit" class="btn btn-primary" style="float:right;" ><i class="glyphicon glyphicon-plus"></i> 新增 <i class="glyphicon glyphicon-user"></i></button></a>
			@endrole
			
		</div>
		<!--中間的線-->
		<div class="line" style="height:30px;border-right:1px solid #D3E0E9;position:absolute;left:783px;top:167px;">
		</div>
	</div>
</div>
</div>
<div class="container" style="width:780px;height:65px;margin-right:218px;">
<div class="panel panel-default">
	<div class="panel-heading" style="height:100%;">
		<div class="row" style="text-align:center;"">
			<div class="col-md-1 " style="border-right:1px solid black;cursor:pointer;" onclick="location.href='{{route('user_byid',$order)}}'">
				<div class="test">
					<span>ID</span>
				</div>
			</div>
			<div class="col-md-3 test" style="border-right:1px solid black;cursor:pointer;" onclick="location.href='{{route('user_byname',$order)}}'">
				<div class="test">
					<span>Name</span>
				</div>
			</div>
			<div class="col-md-2" style="border-right:1px solid black;cursor:pointer;" onclick="location.href='{{route('user_bygroup',$order)}}'">
				<div class="test">
					<span>Group</span>
				</div>
			</div>
			<div class="col-md-2" style="border-right:1px solid black;cursor:pointer;" onclick="location.href='{{route('user_byrole',$order)}}'">
				<div class="test">
					<span>Role</span>
				</div>
			</div>
			<div class="col-md-3" style="border-right:1px solid black;cursor:pointer;" onclick="location.href='{{route('user_bylogin',$order)}}'">
				<div class="test">
					<span>LastLogin</span>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="container" style="width:780px;height:100px;margin-right:218px;">
@foreach($data as $user)

<div class="panel panel-default test" style="cursor:pointer;" onclick="location.href= &quot {{route("user_view", $user->id)}} &quot ">
	<div class="panel-heading" style="height:100%;">
		<div class="row" style="text-align:center;">
			<div class="col-md-1 " style="border-right:1px solid black;" >
				{{$user->id}}
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				{{$user->name}}
			</div>
			<div class="col-md-2" style="border-right:1px solid black;">
				{{$user->user_group_name}}
			</div>
			<div class="col-md-2" style="border-right:1px solid black;">
				{{$user->display_name}}
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				{{$user->login_at}}
			</div>
			<div class="col-md-1">
				
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