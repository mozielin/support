@extends('layouts.master')
@section('title')
<h2 style="margin-top: 2px;">公司狀態總覽</h2>
@endsection
@section('contentm')
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>
<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;text-align:center;"><!--東西置中-->
			<div class="col-md-12">
				<div class="col-md-6" style="border-right:1px solid #D3E0E9;" >
						@if ($errors->any())
						<div class="alert alert-danger" style="width:350px;height:52px;position:absolute;right:-350px;top:-6px;z-index:1;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
								</button>
							<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
							</ul>
						</div>
						@endif
						@if (Session::has('flash_message'))
							<div class="alert alert-success fade in" style="width:250px;position:absolute;left: 386px;top: -6px;text-align:center;z-index: 1;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
								</button>
								{{ Session::get('flash_message') }}
							</div>
						@endif
			 
			    		<div class="input-group" style="width:300px;">
			      		<input type="text"  class="form-control faq" placeholder="Search" name="search" id="search">
			      		<div class="input-group-btn">
			        		<button class="btn btn-primary" id="searchBTN" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			      		</div>
			    		</div>
			    		<div class="{{ $errors->has('status_name') ? ' has-error' : '' }}" "></div>
			    </div>
		   		
			
			<!--右邊的新增區塊-->
			
				<form class="form-horizontal" method="POST" action="{{ route('status_store') }}">
					{{ csrf_field() }}
					<div class="col-md-2">
						<select id="status_class" name="status_class" style="width:80px;padding-right:15px;" class="form-control" required placeholder="請選擇">
							<option value="合約">合約</option>
							<option value="Lic">Lic</option>
							<option value="案件">案件</option>
						</select>
					</div>
					<div class="col-md-3">
						<input id="status_name" type="text" class="form-control" name="status_name" value="{{ old('status_name') }}" placeholder="請輸入狀態名稱" required autofocus style="width:180px;">
					</div>
					<div class="col-md-1">
						<button class="btn btn-primary" style="border-bottom-left-radius:0;border-top-left-radius:0;" type="submit"><i class="glyphicon glyphicon-plus"></i></button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<div class="container" style="width:780px;height:100%;margin-right:218px;">
<div class="panel panel-default">
	<div class="panel-heading" style="height:100%;">
		<div class="row" style="text-align:center;"">
			<div class="col-md-4 " style="border-right:1px solid black;">
				<span>ID</span>
			</div>
			<div class="col-md-4 " style="border-right:1px solid black;">
				<span>Class</span>
			</div>
			<div class="col-md-4" >
				<span>狀態名稱</span>
			</div>
		</div>
	</div>
</div>
</div>
<!--下方的資料產出區塊-->
<div class="container faq-list" style="width:780px;height:100%;margin-right:218px;">
@foreach($status as $test)
<div class="panel panel-default test " style="cursor:pointer;" onclick="location.href='{{route('status_view', $test->id)}}'">
	<div class="panel-heading" style="height:100%;text-align:center;">
		<div class="row">
			<div class="col-md-4" style="border-right:1px solid black;">
				{{$test->id}}
			</div>
			<div class="col-md-4" style="border-right:1px solid black;">
				{{$test->status_class}}
			</div>
			<div class="col-md-4">
				{{$test->status_name}}
			</div>
		</div>
	</div>
</div>
@endforeach


<!--下方的頁數-->
<div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">

{{$status->links()}}

</div>

</div>

<script type="text/javascript">
	$(function () {
     function FullTextContains(innerText, searchTerm) {
         for (x = 0; x < searchTerm.length; x++) {
             if (innerText.toLowerCase().indexOf(searchTerm[x].toLowerCase()) >= 0) {
                 return true;
             }
         }
         return false;
     }

     $('.faq').on('keyup input', function (e) {
         var text = $.trim($(this).val());
         if (e.keyCode == 13) {
             Search(text);
         } else if (text == '') {
             Search('');
         }
     });

     $('#search').on('keyup', function (e) {
         var text = $.trim($('.faq').val());
         Search(text);
     });

     $('#searchBTN').on('click', function (e) {
         var text = $.trim($('.faq').val());
         Search(text);
     });

    $('#search').on('click',function(){
		document.getElementById("search").value="";
	})

     function Search(searchTermText) {
         var searchTerm = searchTermText.split(' ');
         console.log(searchTerm);
         if (searchTermText != '') {
             $(".faq-list .panel").filter(function (index) {
                 var panelText = $.trim($(this).text());
                 if (FullTextContains(panelText, searchTerm) == true) {
                     console.log("found it");
                     return true;
                 } else {
                     console.log("not found");
                     $(this).slideUp();
                     return false;
                 }
             }).slideDown();
         } else {
             $(".faq-list .panel").slideDown();
         }
     }
 });
</script>
@endsection