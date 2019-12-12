@extends('layouts.master')

@section('title')
<h2 style="margin-top: 2px">Dashboard</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>
<div class="container" style="width:780px;min-height:250px;height:100%;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:400px;">
		    <div class="panel-body" style="height:100%">
        	<div class="form-horizontal" style="height:100%">

            <div class="form-group col-md-12 form-horizontal"> 
              <div class="col-md-8" style="text-align: center;height:100px; ">
                @if (Session::has('checkno_message'))
                  <div class="alert alert-info fade in" style="width:300px;position:absolute;right:-38px;top:20px;text-align:center;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
                    </button>
                    {{ Session::get('checkno_message') }}
                  </div>
                @endif
                @if (Session::has('check_message'))
                  <div class="alert alert-success fade in" style="width:300px;position:absolute;right:-38px;top:20px;text-align:center;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
                    </button>
                    {{ Session::get('check_message') }}
                  </div>
                @endif
              </div>
            </div>   

        		<div class="form-group col-md-12 form-horizontal"> 
                @role('admin','devenlope')
                	<div class="col-md-2" style="text-align: center;">
                    <button type="button" style="" class="btn btn-primary" onclick="location.href='{{route('contractcheck')}}'"><i class="glyphicon glyphicon-file"></i> 合約-Scan </button>
                	</div>
                  <div class="col-md-2" style="text-align: center;">
                    <button type="button" style="" class="btn btn-primary" onclick="location.href='{{route('licensecheck')}}'"><i class="glyphicon glyphicon-lock"></i> Lic-Scan </button>
                  </div> 
                  <div class="col-md-2" style="text-align: center;">
                    <button type="button"  class="btn btn-primary" onclick="location.href='{{route('tlccheck')}}'"><i class="glyphicon glyphicon-facetime-video"></i> TLC-Scan </button>
                  </div> 
				  <div class="col-md-2" style="text-align: center;">
                    <button type="button"  class="btn btn-primary" onclick="location.href='{{route('customecheck')}}'"><i class="glyphicon glyphicon-facetime-video"></i> CLC-Scan </button>
                  </div>
                  <div class="col-md-2" style="text-align: center;">
                    <button type="button" style="float:left;" class="btn btn-primary" onclick="location.href='{{route('servercatch')}}'"><i class="glyphicon glyphicon-th"></i> Ver-Scan </button>
                  </div>   
                @endrole
            </div> 

            <div class="form-group col-md-12 form-horizontal" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;"> 
                  <div class="col-md-3" style="text-align: center;">
                    <button type="button"  class="btn btn-primary"  onclick="location.href='{{route('seadmin_uploadlic')}}'"><i class="glyphicon glyphicon-send"></i> Lic分析 </button>
                  </div>
                  @role('admin','devenlope')
                  <div class="col-md-3" style="text-align: center;">
                    <button type="button"  class="btn btn-primary"  onclick="location.href='{{route('version_index')}}'"><i class="glyphicon glyphicon-list-alt"></i> 版號管理 </button>
                  </div> 
                  <div class="col-md-3" style="text-align: center;">
                    <a href="{{route('function_all')}}"><button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-plus"></i> Fun </button></a>
                  </div> 
                  <div class="col-md-3" style="text-align: center;">
                    <a href="{{route('companytrash')}}"><button type="submit" class="btn btn-primary"  ><i class="glyphicon glyphicon-trash"></i> 垃圾桶 </button></a>
                  </div>   
                  @endrole

            </div>

            <div class="form-group col-md-12 form-horizontal" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;"> 

                  <div class="col-md-3" style="text-align: center;">
                  @role('admin','devenlope')
                  <button type="button" style="" class="btn btn-primary" onclick="location.href='{{route('APIswitch')}}'"><i class="glyphicon glyphicon-refresh"></i> {{$data->mode}} </button>
                  @endrole
                  </div>
                  
                  <div class="col-md-3" style="text-align: center;">
                  @role('admin','devenlope')
                    <button type="button"  class="btn btn-primary"  onclick="location.href='{{route('version_index')}}'"><i class="glyphicon glyphicon-flash"></i> API測試 </button>
                  @endrole
                  </div> 
                  <div class="col-md-3" style="text-align: center;">
                  @role('admin','devenlope')
                    <button type="button"  class="btn btn-primary"  onclick="location.href='{{route('version_index')}}'"><i class="glyphicon glyphicon-envelope"></i> Mail測試 </button>
                  @endrole  
                  </div> 
                  <div class="col-md-3" style="text-align: center;">
                  @role('admin','devenlope')
                    <button type="button"  class="btn btn-primary"  onclick="location.href='{{route('version_index')}}'"><i class="glyphicon glyphicon-bold"></i> Both測試 </button>
                  @endrole  
                  </div>   

            </div>
            
			  </div>
			</div>
		</div>
	</div>
</div>
@endsection

