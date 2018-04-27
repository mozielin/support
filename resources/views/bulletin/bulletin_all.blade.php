@extends('layouts.master')

@section('title')
	<h2 style="margin-top: 2px">公告總覽</h2>
@endsection

@section('contentm')

<script type="text/javascript">
	$('#bulletinsearch').ready(function(){								
		$value='1';
		$.ajax({
			type : 'get',
			url : '{{ URL::to('/bulletin/bulletinload') }}',
			data : {'bulletinsearch' : $value},
			success : function(data){
				console.log(data);
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
			<div class="col-md-12">
				<div class="col-md-6" style="height:45px;border-right:1px solid #D3E0E9;">
				<!--左邊的搜尋區塊-->
		    	<div class="left-side" style="height:57px;text-align:center;margin-top:3px;">
					<div class="form-horizontal">
						<div class="input-group{{ $errors->has('bulletinsearch') ? ' has-error' : '' }}">
							<input id="bulletinsearch" type="text" class="form-control" name="bulletinsearch" value="" placeholder="請輸入公告標題" autofocus style="width:240px;"/>
							<div class="input-group-btn">
			        			<button class="btn btn-primary" id="searchBTN" style="margin-right:50px;" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			      			</div>                     
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
				</div>
				
				
				<div class="col-md-5 col-md-offset-1 right-side">
				<!--右邊的新增區塊-->	
				@permission('bulletin_view')
					@permission('bulletin_create')
						@if (Session::has('flash_message'))
							<div class="alert alert-success" style="width:250px;position:absolute;right:92px;bottom:-33px;text-align:center;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
								</button>
								{{ Session::get('flash_message') }}
							</div>
						@endif
						<button type="button" class="btn btn-primary" style="margin-top:3px;float: right;" onclick="location.href='{{route('bulletin_create')}}'"><i class="glyphicon glyphicon-plus"></i>
		                		新增
		                </button>
	                @endpermission	
                @endpermission				    			        
		    	</div>
			</div>	    
		</div>
	</div>
</div>


<div class="container" style="width:780px;min-height:250px;height:100%;margin-right:218px;">	

<table style="width:100%;">

	<thead>
	<div class="panel panel-default">
		<div class="panel-heading" style="height:100%;">				
			<div class="row" style="text-align:center;"">
				<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">
					<span>公告編號</span>			
				</div>
				<div class="col-md-4" style="border-right:1px solid black;">
					<span>公告名稱</span>			
				</div>
				<div class="col-md-3 test" name="loadbytime" id="loadbytime" style="cursor:pointer;" isclick="N">
					<span>發佈日期</span>			
				</div>
				<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">
					<span>編輯者</span>			
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
								$('#bulletinsearch').on('keyup',function(){								
									$value=$(this).val();
									$.ajax({
										type : 'get',
										url : '{{ URL::to('/bulletin/bulletinsearch') }}',
										data : {'bulletinsearch' : $value},
										success : function(data){
											console.log(data);
											$('tbody').html(data);

											
										}
									})
								})

								
									

							</script>


@endsection