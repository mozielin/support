@extends('layouts.master')

@section('title')
	<div style="width:150px; float:left;" >
		<h2 style="margin-top:2px;">新增群組</h2>
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
	<div class="panel panel-default">
		<div class="panel-heading" style="height:100%;">
			<div class="row-menu" style="height:40px;">






			<!--
				<div id = "menu">
					<ul>
						<li><a href="http://192.168.1.95/company">客戶總覽</a></li>
						<li><a href="http://192.168.1.95/plan">客戶方案</a></li>
						<li><a href="#">Server info</a></li>
						<li><a href="#">案件型態</a></li>
						<li><a href="http://192.168.1.95/group">公司型態</a></li>
						<li><a href="http://192.168.1.95/industry">公司產業別</a></li>
					</ul>>
				</div>

				#menu ul{
						list-style-type: none;
						margin: 0;
						padding: 0;
						overflow: hidden;
						border: 1px solid #e7e7e7;
    					background-color: #f3f3f3;
					}

					#munu ul li{
							float: left;
					}

					#munu ul li a{
							display: block;
						    color: #666;
						    text-align: center;
						    padding: 14px 16px;
						    text-decoration: none;
					}

					#munu ul li a:hover:not(.active){
							color: white;
							background-color: #4CAF50;
					}
						-->









				
			<ul class="drop-down-menu1">
			        <li style="border-color:#D3E0E9;"><a href="http://192.168.1.95/company">客戶總覽</a>
			        </li>
			        <li><a href="http://192.168.1.95/plan">客戶方案</a>
			        </li>
			        <li><a href="#">Server info</a>
			        </li>
			        <li><a href="#">案件型態</a>
			        </li>
			        <li><a href="http://192.168.1.95/group">公司型態</a>
			        </li>
			        <li><a href="http://192.168.1.95/industry">公司產業別</a>
			        </li>
				</ul>

				




			</div>
		</div>
	</div>
</div>


<!--中間新增與搜尋-->
<div class="container" style="width:780px;height:80px;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:62px;display:flex;justify-content:center;text-align:center;"><!--東西置中-->
		    <!--左邊的搜尋區塊-->
		    <div class="left-side" style="width:360px;height:57px;float:right;display:flex;justify-content:center;text-align:center;margin-top:3px;">
				<form class="form-horizontal" method="POST" action="{{ route('user_group_store') }}">
					{{ csrf_field() }}
					<div class="form-group{{ $errors->has('user_group_name') ? ' has-error' : '' }}">
						<input id="company_industry_name" group="text" class="form-control" name="user_group_name" value="{{ old('user_group_name') }}" placeholder="請輸入群組名稱" required autofocus style="width:240px;float:left;margin-right:10px;"></input>   			  
			               <button type="submit" class="btn btn-primary" style="float:left;"> 搜尋 </button>              
				    </div>
			    </form>
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
						<div class="form-group{{ $errors->has('user_group_name') ? ' has-error' : '' }}" ">
							<input id="user_group_name" type="text" class="form-control" name="user_group_name" value="{{ old('user_group_name') }}" placeholder="請輸入群組名稱" required autofocus style="width:240px;float:left;margin-right:10px;"></input>   			  
			                <button type="submit" class="btn btn-primary" style="float:left;" > 新增 </button>              
				    	</div>
			    </form>
		    </div>
		    <!--中間的線-->
			<div class="line" style="height:30px;border-right:1px solid #D3E0E9;position:absolute;left:783px;top:167px;">
    		</div>
		</div>
	</div>
</div>
<div class="container" style="width:780px;height:100px;margin-right:218px;">
	@foreach($data as $group)
		    <div class="panel panel-default">
		  	  	<div class="panel-heading">
		  	  		<div class="row" style="text-align:center;">
		  	  			<div class="col-md-6" style="border-right:1px solid black;">
						 	<span>henry's wife :</span>	
						    {{$group->user_group_name}}
					    </div>
					    <div class="col-md-6">
							<div class="container-button">
		                        <a href="{{route('user_group_view', $group->id)}}">編輯</a>
		                    </div>
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
