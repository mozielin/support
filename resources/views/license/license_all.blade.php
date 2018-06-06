@extends('layouts.master')

@section('title')
<div class="col-md-6">
<h2 style="margin-top: 2px">License</h2>
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
	$('#licsearch').ready(function(){								
		$value='1';
		$.ajax({
		type : 'get',
		url : '{{ URL::to('/license/loadlic') }}',
		data : {'licsearch' : $value},
			success : function(data){
			console.log(data);
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
			<div class="left-side" style="width:360px;height:57px;display:flex;text-align:center;margin-top:3px;">	
					<div class="input-group" style="width:240px;">
						<input id="licsearch" type="text" class="form-control" name="licsearch" value="{{ old('licsearch') }}" placeholder="請輸入公司名稱查詢" required autofocus style="width:240px;margin-left: 40px;">
						<div class="input-group-btn">
			        		<button class="btn btn-primary" id="searchBTN" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			      		</div>
				    </div>
		    </div>
			@if (Session::has('checkno_message'))
				<div class="alert alert-info fade in" style="width:250px;position:absolute;right:350px;top:154px;text-align:center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
					</button>
					{{ Session::get('checkno_message') }}
				</div>
			@endif
			@if (Session::has('check_message'))
				<div class="alert alert-warning fade in" style="width:250px;position:absolute;right:350px;top:154px;text-align:center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
					</button>
					{{ Session::get('check_message') }}
				</div>
			@endif
			<!--右邊的新增區塊-->
			<div class="right-side" style="width:360px;height:57px;margin-top:3px;float:right;">
				@role('devenlope')
				<button type="button" style="" class="btn btn-primary" onclick="location.href='{{route('licensecheck')}}'"><i class="glyphicon glyphicon-info"></i> Scan </button>
				@endrole	  	
				@permission('license_create_by')
				<a href="{{route('license_create')}}"><button type="submit" class="btn btn-primary" style="float:right;" ><i class="glyphicon glyphicon-plus"></i> 新增 </button></a>
				@endpermission
				@role('devenlope')
				<a href="{{route('function_all')}}"><button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-plus"></i> Fun  </button></a>
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

			<div class="col-md-1" style="border-right:1px solid black; border-left:1px solid black;">	
					ID
				</div>
			
			<div class="col-md-3" style="border-right:1px solid black;">	
				Lic名稱
				</div>	

			<div class="col-md-3" style="border-right:1px solid black;">	
					開始日期
				</div>

			<div class="col-md-3" style="border-right:1px solid black;">	
					結束日期
				</div>

			<div class="col-md-2" style="border-right:1px solid black;">	
					狀態
				</div>	
					
			</div>              				
		</div>		
	</div>
		
	</thead>
	<tbody>
		
	</tbody>
	</table>

							<script type="text/javascript">
								$('#licsearch').on('keyup',function(){								
									$value=$(this).val();
									$.ajax({
										type : 'get',
										url : '{{ URL::to('/license/licsearch') }}',
										data : {'licsearch' : $value},
										success : function(data){
											
											console.log(data);
											$('tbody').html(data);	
										}
									})
								})

								$('#searchBTN').on('click',function(){								
									$value = $('#licsearch').val();
									$.ajax({
										type : 'get',
										url : '{{ URL::to('/license/licsearch') }}',
										data : {'licsearch' : $value},
										success : function(data){
											console.log(data);
											$('tbody').html(data);	
										}
									})
								})


								$('#licsearch').on('click',function(){
									document.getElementById("licsearch").value="";
								})

								
									

							</script>
							
</div>

							
@endsection
