@extends('layouts.master')
@section('title')
<div class="col-md-6">
<h2 style="margin-top: 2px;">Server列表</h2>
</div>
<div class="col-md-6">
<p style="float: right;">總數:{{$count}}</p>
</div>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>

<script type="text/javascript">
	$('#serversearch').ready(function(){
		$value='1';

		$.ajax({
			type : 'get',
			url : '{{ URL::to('/server/loadserver') }}',
			data : {'serversearch' : $value},
			success : function(data){
				console.log(data);
				document.getElementById("serversearch").value="";
				$('tbody').html(data);
			}
		})
	})					
</script>

<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;display:flex;justify-content:center;text-align:center;"><!--東西置中-->
		<!--左邊的搜尋區塊-->
		<div class="left-side" style="width:360px;height:57px;float:right;display:flex;justify-content:center;text-align:center;margin-top:3px;">
				<div class="input-group" style="width:280px;">
			      	<input id="serversearch" type="text" class="form-control" name="serversearch" value="{{ old('serversearch') }}" placeholder="請輸入ip" autofocus style="width:240px">
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
		@if (Session::has('check_message'))
				<div class="alert alert-success fade in" style="width:250px;position:absolute;right:380px;top:154px;text-align:center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
					</button>
					{{ Session::get('check_message') }}
				</div>
			@endif
		<!--右邊的新增區塊-->
		<div class="right-side" style="width:360px;height:57px;margin-top:3px;">
			@role('devenlope')
			<button type="button" style="float:left;" class="btn btn-primary" onclick="location.href='{{route('servercatch')}}'"><i class="glyphicon glyphicon-info"></i> test </button>
			@endrole
			@permission('devenlope')
			<button type="button" style="float:right;" class="btn btn-primary" onclick="location.href='{{route('server_create')}}'"><i class="glyphicon glyphicon-plus"></i> 新增Server </button>
			@endpermission
		</div>
		<!--中間的線-->
		<div class="line" style="height:30px;border-right:1px solid #D3E0E9;position:absolute;left:783px;top:167px;">
		</div>
	</div>
</div>
</div>
<div class="container" style="width:780px;min-height:250px;height:100%;margin-right:218px;">
<table style="width:100%">
	<thead>
<div class="panel panel-default">
	<div class="panel-heading" style="height:100%;">
		<div class="row" style="text-align:center;"">
			<div class="col-md-2" style="border-right:1px solid black;">
				<span>Type</span>
			</div>
			<div class="col-md-2" style="border-right:1px solid black;">
				<span>公司名稱</span>
			</div>
			<div class="col-md-6" style="border-right:1px solid black;">
				<span>站台位置</span>
			</div>
			<div class="col-md-2" style="border-right:1px solid black;">
				<span>Sync版號</span>
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
		$('#serversearch').on('keyup',function(){									
			$value=$(this).val();
				$.ajax({
					type : 'get',
					url : '{{ URL::to('/server/serversearch') }}',
					data : {'serversearch' : $value},
					success : function(data){
					console.log(data);
					$('tbody').html(data);
					}
				})
		})

		$('#searchBTN').on('click',function(){									
			$value = $('#serversearch').val();
				$.ajax({
					type : 'get',
					url : '{{ URL::to('/server/serversearch') }}',
					data : {'serversearch' : $value},
					success : function(data){
					console.log(data);
					$('tbody').html(data);
					}
				})
		})


		$('#serversearch').on('click',function(){
			document.getElementById("serversearch").value="";
		})
	</script>
@endsection
