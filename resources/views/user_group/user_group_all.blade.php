@extends('layouts.master')

@section('title')
	<div style="width:150px; float:left;" >
		<h2 style="margin-top:2px;">Group列表</h2>
	</div>
	

	@if (Session::has('flash_message'))
		<div class="alert alert-success" style="width:200px;float:right;text-align:center;">
			<button group="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
			</button>
			{{ Session::get('flash_message') }}
		</div>
	@endif

@endsection

@section('contentm')			

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.user_center_block')
</div>

<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;display:flex;justify-content:center;text-align:center;"><!--東西置中-->
		    <!--左邊的搜尋區塊-->
		    <div class="left-side" style="width:360px;height:57px;float:right;display:flex;justify-content:center;text-align:center;margin-top:3px;">
				
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
			<!--左邊的新增區塊-->
			<div class="left-side" style="width:360px;height:57px;float:left;display:flex;justify-content:center;text-align:center;margin-top:3px;">
				<form class="form-horizontal" method="POST" action="{{ route('user_group_store') }}">
						{{ csrf_field() }}
						<div class="input-group{{ $errors->has('user_group_name') ? ' has-error' : '' }}" ">
							<input id="user_group_name" type="text" class="form-control" name="user_group_name" value="{{ old('user_group_name') }}" placeholder="請輸入群組名稱" required autofocus style="width:250px;margin-left:20px;">
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
					<span>群組名稱</span>			
				</div>
		    </div>              				
		</div>		
	</div>
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
	@foreach($data as $group)
		    <div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('user_group_view', $group->id)}}'">
		  	  	<div class="panel-heading">
		  	  		<div class="row" style="text-align:center;">
		  	  			<div class="col-md-6" style="border-right:1px solid black;">
						    {{$group->id}}
					    </div>
					    <div class="col-md-6">
							{{$group->user_group_name}}
	                    </div>

                    </div>
				</div>
		    </div>		
	@endforeach
</div>

<div class="container" style="width:41%;text-align:center;">
	{{$data->links()}}
</div>


@endsection
