@extends('layouts.master')

@section('title')
<div class="col-md-6">
<h2 style="margin-top: 2px">合約與發票</h2>	
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
	$('#contractsearch').ready(function(){
		$value='1';

		$.ajax({
			type : 'get',
			url : '{{ URL::to('/contract/loadcon') }}',
			data : {'contractsearch' : $value},
			success : function(data){
				console.log(data);
				document.getElementById("contractsearch").value="";
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
			<div class="left-side" style="width:360px;height:57px;float:right;display:flex;text-align:center;margin-top:3px;">
				<div class="input-group" style="width:240px;">
						<input id="contractsearch" type="text" class="form-control" name="contractsearch" value="{{ old('contractsearch') }}" placeholder="請輸入查詢內容" required autofocus style="width:240px;margin-left: 40px;">
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
				@if (Session::has('checkno_message'))
				<div class="alert alert-info fade in" style="width:250px;position:absolute;right:350px;top:154px;text-align:center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
					</button>
					{{ Session::get('checkno_message') }}
				</div>
				@endif
				@if (Session::has('check_message'))
				<div class="alert alert-success fade in" style="width:250px;position:absolute;left:800px;top:155px;text-align:center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
					</button>
					{{ Session::get('check_message') }}
				</div>
				@endif
				@role('devenlope')
				<button type="button" style="" class="btn btn-primary" onclick="location.href='{{route('contractcheck')}}'"><i class="glyphicon glyphicon-info"></i> test </button>	  
				@endrole
				@permission('contract_create')
				<a href="{{route('contract_create')}}"><button type="submit" class="btn btn-primary" style="float:right;" >
				<i class="glyphicon glyphicon-plus"></i> 
				新增 </button></a>    
				@endrole

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
	
	<div class="panel panel-default" >
		<div class="panel-heading " style="height:100%;">				
			<div class="row" style="text-align:center;">

			<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">	
					公司名稱
				</div>
			
			<div class="col-md-3" style="border-right:1px solid black;">	
					合約名稱
				</div>	

			<div class="col-md-2" style="border-right:1px solid black;">	
					授權人數
				</div>

			<div class="col-md-2" style="border-right:1px solid black;">	
					結束日期
				</div>

			<div class="col-md-2" style="border-right:1px solid black;">	
					合約狀態
				</div>	
					
			</div>              				
		</div>		
	</div>
		
	</thead>
	<tbody>
		
	</tbody>
	</table>

	<script type="text/javascript">
		$('#contractsearch').on('keyup',function(){									
			$value=$(this).val();
				$.ajax({
					type : 'get',
					url : '{{ URL::to('/contract/contractsearch') }}',
					data : {'contractsearch' : $value},
					success : function(data){
					console.log(data);
					$('tbody').html(data);
					}
				})
		})

		$('#searchBTN').on('click',function(){									
			$value = $('#contractsearch').val();
				$.ajax({
					type : 'get',
					url : '{{ URL::to('/contract/contractsearch') }}',
					data : {'contractsearch' : $value},
					success : function(data){
					console.log(data);
					$('tbody').html(data);
					}
				})
		})

		$('#contractsearch').on('click',function(){
			document.getElementById("contractsearch").value="";
		})


	</script>
							

	<div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">

	</div>
</div>

							
@endsection
