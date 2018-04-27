@extends('layouts.master')
@section('title')
<h2 style="margin-top: 2px">日誌總覽</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>

<script type="text/javascript">
	$('#activitysearch').ready(function(){
		$value=' ';

		$.ajax({
			type : 'get',
			url : '{{ URL::to('/activity/activityload') }}',
			data : {'activitysearch' : $value},
			success : function(data){
				console.log(data);
				document.getElementById("activitysearch").value="";
				$('tbody').html(data);
			}
		})
	})					
</script>

<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;text-align:center;"><!--文字置中-->
		    @if ($errors->any())
		    <div class="alert alert-danger" style="height:52px;position:absolute;right:629px;top:155px;">
		        <ul>
            	 @foreach ($errors->all() as $error)
            		<li>{{ $error }}</li>
           		 @endforeach
        		</ul>
    		</div>
			@endif
			@if (Session::has('flash_message'))
				<div class="alert alert-success fade in" style="width:250px;position:absolute;right:350px;top:154px;text-align:center;z-index:99;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
					</button>
					{{ Session::get('flash_message') }}
				</div>
			@endif
			<!--右邊的新增區塊-->
			<div class="right-side" style="width:300px;height:57px;display:flex;justify-content:center;text-align:center;margin-top:3px;">	
					<div class="input-group" style="width:300px;">
						<input id="activitysearch" type="text" class="form-control" name="activitysearch" value="{{ old('activitysearch') }}" placeholder="請輸入查詢內容" required autofocus style="width:240px;margin-left: 40px;">
						<div class="input-group-btn">
			        		<button class="btn btn-primary" id="searchBTN" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			      		</div>
				    </div>
		    </div>
		    @permission('company_create')
				<a href="{{route('company_create')}}"><button type="submit" class="btn btn-primary" style="float:right;position:absolute;top:162px;right:255px;" ><i class="glyphicon glyphicon-plus"></i> 新增 </button></a>
			@endpermission 
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
				<span>異動資料</span>
			</div>
			<div class="col-md-3" style="border-right:1px solid black;">
				<span>資料名稱</span>
			</div>
			<div class="col-md-2" style="border-right:1px solid black;">
				<span>行為</span>
			</div>
			<div class="col-md-2" style="border-right:1px solid black;">
				<span>使用者</span>
			</div>
			<div class="col-md-3">
				<span>日期</span>
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
		$('#activitysearch').on('keyup',function(){									
			$value=$(this).val();
				$.ajax({
					type : 'get',
					url : '{{ URL::to('/activity/activitysearch') }}',
					data : {'activitysearch' : $value},
					success : function(data){
					console.log(data);
					$('tbody').html(data);
					}
				})
		})

		$('#searchBTN').on('click',function(){									
			$value = $('#activitysearch').val();
				$.ajax({
					type : 'get',
					url : '{{ URL::to('/activity/activitysearch') }}',
					data : {'activitysearch' : $value},
					success : function(data){
					console.log(data);
					$('tbody').html(data);
					}
				})
		})

		$('#activitysearch').on('click',function(){
			document.getElementById("activitysearch").value="";
		})


	</script>

@endsection