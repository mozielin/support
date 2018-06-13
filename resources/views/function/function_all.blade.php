@extends('layouts.master')

@section('title')
	<div style="width:auto; float:left;" >
		<h2 style="margin-top:2px;">選購功能總覽</h2>
	</div>

@endsection

@section('contentm')			

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>

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
				<div class="alert alert-success fade in" style="width:250px;position:absolute;left:470px;top:154px;text-align:center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
					</button>
					{{ Session::get('flash_message') }}
				</div>
			@endif
			<!--右邊的新增區塊-->
			<div class="right-side" style="width:500px;height:57px;float:right;display:flex;justify-content:center;text-align:center;margin-top:3px;">	  	
				<form class="form-horizontal" method="POST" action="{{ route('function_store') }}">
					{{ csrf_field() }}
					<div class="col-md-2">
						<select id="select" name="select" style="width:80px;padding-right:15px;" class="form-control" required placeholder="是否綁定LIC">
							<option value="0">是</option>
							<option value="1">否</option>
						</select>
					</div>
					<div class="input-group{{ $errors->has('function_name') ? ' has-error' : '' }}">
						<input id="function_name" type="text" class="form-control" name="function_name" value="{{ old('function_name') }}" placeholder="請輸入功能名稱" required autofocus style="width:125px;margin-left:20px;">
						<input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="請輸入功能code" required autofocus style="width:125px;margin-left:20px;">
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
				<div class="col-md-6 " style="border-right:1px solid black;">
					<span>ID</span>			
				</div>
				<div class="col-md-6">
					<span>功能名稱</span>			
				</div>
		    </div>              				
		</div>		
	</div>
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
	@foreach($function as $test)
		    <div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('function_view', $test->id)}}'">
		  	  	<div class="panel-heading">
		  	  		<div class="row" style="text-align:center;">
		  	  			<div class="col-md-6" style="border-right:1px solid black;">
						    {{$test->id}}
					    </div>
					    <div class="col-md-6">
					    	{{$test->function_name}}
	                    </div>
                    </div>
				</div>
		    </div>		
	@endforeach

	<div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">
			{{$function->links()}}
	</div>
	
</div>

@endsection
