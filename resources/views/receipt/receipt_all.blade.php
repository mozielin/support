@extends('layouts.master')

@section('title')
	<h2 style="margin-top: 2px">發票總覽</h2>
@endsection

@section('contentm')

	<script type="text/javascript">
								$('#receiptsearch').ready(function(){								
									$value='1';
									$.ajax({
										type : 'get',
										url : '{{ URL::to('/receipt/receiptload') }}',
										data : {'receiptsearch' : $value},
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
				<div class="col-md-5">
				<!--左邊的搜尋區塊-->
		    	<div class="left-side" style="height:57px;text-align:center;margin-top:3px;">
					<div class="form-horizontal">
						<div class="input-group{{ $errors->has('seadminsearch') ? ' has-error' : '' }}">
							<input id="seadminsearch" type="text" class="form-control" name="seadminsearch" value="" placeholder="請輸入搜尋目標" autofocus style="width:240px;float:left;"/>
							<div class="input-group-btn">
			        		<button class="btn btn-primary" id="searchBTN" type="submit"><i class="glyphicon glyphicon-search"></i></button>
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
				<div class="col-md-1">
				<!--中間的線-->
				<div class="line" style="height:40px;border-right:1px solid #D3E0E9;">
    			</div>
				</div>
				<div class="col-md-5 col-md-offset-1 right-side">
				<!--右邊的新增區塊-->
					@if (Session::has('checkno_message'))
					<div class="alert alert-info fade in" style="width:250px;position:absolute;right:100px;top:-6px;text-align:center;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
						</button>
						{{ Session::get('checkno_message') }}
					</div>
					@endif
					@if (Session::has('check_message'))
				<div class="alert alert-success fade in" style="width:250px;position:absolute;right:100px;top:-6px;text-align:center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
					</button>
					{{ Session::get('check_message') }}
				</div>
				@endif						    			        
		    	</div>
			</div>	    
		</div>
	</div>
</div>


<div class="container" style="width:780px;height:100%;margin-right:218px;">	

<table style="width:100%;">

	<thead>
	<div class="panel panel-default">
		<div class="panel-heading" style="height:100%;">				
			<div class="row" style="text-align:center;">
				<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">
					<span>公司名稱</span>			
				</div>
				<div class="col-md-3" style="border-right:1px solid black;">
					<span>合約標題</span>			
				</div>
				<div class="col-md-3" style="border-right:1px solid black;">
					<span>發票號碼</span>			
				</div>
				<div class="col-md-3 test" name="loadbytime" id="loadbytime" style="cursor:pointer;" isclick="N">
					<span>發票日期</span>			
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
								$('#receiptsearch').on('keyup',function(){								
									$value=$(this).val();
									$.ajax({
										type : 'get',
										url : '{{ URL::to('/receipt/receiptsearch') }}',
										data : {'receiptsearch' : $value},
										success : function(data){
											
											console.log(data);
											$('tbody').html(data);	
										}
									})
								})

								$('#searchBTN').on('click',function(){								
									$value = $('#receiptsearch').val();
									$.ajax({
										type : 'get',
										url : '{{ URL::to('/receipt/receiptsearch') }}',
										data : {'receiptsearch' : $value},
										success : function(data){
											console.log(data);
											$('tbody').html(data);	
										}
									})
								})


								$('#receiptsearch').on('click',function(){
									document.getElementById("receiptsearch").value="";
								})

							</script>
							<!--以下程式碼導致資料傳遞錯誤再修正...

							<script type="text/javascript">

							$('#loadbytime').click(function(){

								if ($(this).attr('isclick') == 'Y') {
									$value='1';
									$.ajax({
										type : 'get',
										url : '{{ URL::to('/seadmin/seadminload') }}',
										data : {'seadminsearch' : $value},
										success : function(data){
											console.log(data);
											$('tbody').html(data);

											}
									})
				                   
				                   $(this).attr('isclick', 'N');
				               }
				               else {
				                   $value='1';
									$.ajax({
										type : 'get',
										url : '{{ URL::to('/seadmin/seadminloadbytime') }}',
										data : {'loadbytime' : $value},
										success : function(data){
											console.log(data);
											$('tbody').html(data);
										}
									})
									
				                   $(this).attr('isclick', 'Y');
				               }
							})
									
							</script>-->

@endsection