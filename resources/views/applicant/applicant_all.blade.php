@extends('layouts.master')
@section('title')
<h2 style="margin-top: 2px">聯絡人清單</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>

<script type="text/javascript">
	$('#applicantsearch').ready(function(){
		$value='1';

		$.ajax({
			type : 'get',
			url : '{{ URL::to('/applicant/loadapplicant') }}',
			data : {'applicantsearch' : $value},
			success : function(data){
				console.log(data);
				document.getElementById("applicantsearch").value="";
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
					<input id="applicantsearch" name="applicantsearch" type="text" class="form-control" placeholder="請輸入使用者名稱" on required autofocus style=""></input>
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
			@role('devenlope')
			<a href="{{route('applicant_create')}}"><button type="submit" class="btn btn-primary" style="float:right;" ><i class="glyphicon glyphicon-plus"></i> 新增 </button></a>
			@endrole
			@role('devenlope')
			<button type="submit" class="btn btn-primary" id="vip" checkSelect="N" style="float:left;">V.I.P</button>
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
					<div class="col-md-3" style="border-right:1px solid black;">
						公司名稱
					</div>
					<div class="col-md-2" style="border-right:1px solid black;">
						聯絡人
					</div>
					<div class="col-md-3" style="border-right:1px solid black;">
						聯絡電話
					</div>
					
					<div class="col-md-4" style="border-right:1px solid black;">
						Email
					</div>
					
				</div>
			</div>
		</div>
		
	</thead>
	<tbody>
		
	</tbody>
</table>

<script type="text/javascript">
$('#applicantsearch').on('keyup',function(){
	$value=$(this).val();
	$.ajax({
		type : 'get',
		url : '{{ URL::to('/applicant/applicantsearch') }}',
		data : {'applicantsearch' : $value},
		success : function(data){
		console.log(data);
		$('tbody').html(data);
		}		
	})
})

$('#searchBTN').on('click',function(){
	$value = $('#applicantsearch').val();
	$.ajax({
		type : 'get',
		url : '{{ URL::to('/applicant/applicantsearch') }}',
		data : {'applicantsearch' : $value},
		success : function(data){
		console.log(data);
		$('tbody').html(data);
		}		
	})
})

$('#vip').on('click',function(){
	$value = $('#applicantsearch').val();
	if ($(this).attr('checkSelect') == 'N') {
        document.getElementById('vip').innerText = "A.L.L";
        $(this).attr('checkSelect', 'Y');
        $.ajax({
		type : 'get',
		url : '{{ URL::to('/applicant/vip') }}',
		data : {'applicantsearch' : $value},
		success : function(data){
		console.log(data);
		$('tbody').html(data);
		}		
	})
    }
    else {
        document.getElementById('vip').innerText = "V.I.P";
        $(this).attr('checkSelect', 'N');
        $value='1';
		$.ajax({
			type : 'get',
			url : '{{ URL::to('/applicant/loadapplicant') }}',
			data : {'applicantsearch' : $value},
			success : function(data){
				console.log(data);
				document.getElementById("applicantsearch").value="";
				$('tbody').html(data);
			}
		})
    }                                  
})

$('#applicantsearch').on('click',function(){
	document.getElementById("applicantsearch").value="";
})


</script>


</div>

@endsection