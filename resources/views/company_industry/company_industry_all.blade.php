@extends('layouts.master')
@section('title')
<h2 style="margin-top: 2px;">公司產業總覽</h2>
@endsection
@section('contentm')
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>
<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;text-align:center;"><!--文字置中-->
		@if ($errors->any())
		<div class="alert alert-danger" style="height:52px;position:absolute;right:620px;top:155px;">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		@if (Session::has('flash_message'))
			<div class="alert alert-success fade in" style="width:250px;position:absolute;left:470px;top:154px;text-align:center;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
				</button>
				{{ Session::get('flash_message') }}
			</div>
		@endif
		<!--右邊的新增區塊-->
			<div class="right-side" style="width:360px;height:57px;float:right;display:flex;justify-content:center;text-align:center;margin-top:3px;">	  	
				<form class="form-horizontal" method="POST" action="{{ route('company_industry_store') }}">
					{{ csrf_field() }}
					<div class="input-group{{ $errors->has('company_industry_name') ? ' has-error' : '' }}">
						<input id="company_industry_name" type="text" class="form-control" name="company_industry_name" value="{{ old('company_industry_name') }}" placeholder="請輸入產業名稱" required autofocus style="width:250px;margin-left:20px;">
						<div class="input-group-btn">    
			               <button type="submit" class="btn btn-primary" style="margin-right:20px;"><i class="glyphicon glyphicon-plus"></i> 新增 </button>
			            </div>              
				    </div>
			    </form>
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
			<div class="col-md-6" style="border-right:1px solid black;">
				<span>ID</span>
			</div>
			<div class="col-md-6" >
				<span>產業名稱</span>
			</div>
		</div>
	</div>
</div>
</div>
<!--下方的資料產出區塊-->
<div class="container" style="width:780px;height:100%;margin-right:218px;">
@foreach($industry as $data)
<div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('company_industry_view', $data->id)}}'">
	<div class="panel-heading" style="height:100%;text-align:center;">
		
		<div class="row">
			<div class="col-md-6" style="border-right:1px solid black;">
				<span></span>
				{{$data->id}}
			</div>
			<div class="col-md-6">
				<span></span>
				{{$data->company_industry_name}}
			</div>
		</div>
	</div>
</div>
@endforeach


<!--下方的頁數-->
<div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">
	{{$industry->links()}}
</div>

</div>
@endsection