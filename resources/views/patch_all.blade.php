@extends('layouts.master')
@section('title')
<h2 style="margin-top: 2px">公司總覽</h2>
@endsection
@section('contentm')
<script type="text/javascript">
			$('#dynamicsearch').ready(function(){
								$value='1';
								$.ajax({
									type : 'get',
									url : '{{ URL::to('loadver') }}',
									data : {'dynamicsearch' : $value},
									success : function(data){
										console.log(data);
										document.getElementById("dynamicsearch").value="";
										$('tbody').html(data);
										}
								})
							})
							
</script>
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>
<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;display:flex;justify-content:center;text-align:center;"><!--東西置中-->
		<!--左邊的搜尋區塊-->
		<div class="left-side" style="width:360px;height:57px;float:right;display:flex;justify-content:center;text-align:center;margin-top:3px;">
			<form class="form-horizontal" method="POST" action="{{ route('ver_search') }}">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('dynamicsearch') ? ' has-error' : '' }}">
					<input id="dynamicsearch" type="text" class="form-control" name="dynamicsearch" value="{{ old('dynamicsearch') }}" placeholder="請輸入公司名稱" required autofocus style="width:240px;float:left;margin-right:50px;"></input>
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
		<div class="right-side" style="width:180px;height:57px;float:right;margin-top:3px;">
			@role('admin')
			<a href="{{route('ver_export')}}"><button type="submit" class="btn btn-primary" style="float:right;" > Export </button></a>
			@endrole
			
		</div>
		<div class="right-side" style="width:200px;height:57px;float:right;margin-top:3px;">
			@role('admin')
			<a href="{{route('ver_catch')}}"><button type="submit" class="btn btn-primary" style="float:right;" > Catch </button></a>
			@endrole
			
		</div>
		<!--中間的線-->
		<div class="line" style="height:30px;border-right:1px solid #D3E0E9;position:absolute;left:783px;top:167px;">
		</div>
	</div>
</div>
</div>
<div class="container" style="width:780px;height:65px;margin-right:218px;">
<table style="width:100%;">
	<thead>
		<div class="panel panel-default">
			<div class="panel-heading" style="height:100%;">
				<div class="row" style="text-align:center;"">
					<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">
						<span>統一編號</span>
					</div>
					<div class="col-md-4" style="border-right:1px solid black;">
						<span>公司名稱</span>
					</div>
					<div class="col-md-4">
						<span>網址</span>
					</div>
					<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">
						<span>版本號</span>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</thead>
<tbody>
	
	
</tbody>
</table>
<script type="text/javascript">
	$('#dynamicsearch').on('keyup',function(){
		$value=$(this).val();
		$.ajax({
			type : 'get',
			url : '{{ URL::to('dynamicsearch') }}',
			data : {'dynamicsearch' : $value},
			success : function(data){
				//console.log(data);
				$('tbody').html(data);
			}
		})
	})

	$('#dynamicsearch').on('click',function(){
			document.getElementById("dynamicsearch").value="";
		})
</script>
@endsection