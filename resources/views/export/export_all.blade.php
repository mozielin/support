@extends('layouts.master')

@section('title')
<h2 style="margin-top: 2px">檔案管理</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
	@include('layouts.center_block')
</div>
<div class="container" style="width:780px;min-height:250px;height:100%;margin-right:218px;">
	<div class="panel panel-default">
		<div class="panel-heading" style="height:100%;">
		    <div class="panel-body" style="height:100%">
        	<div class="form-horizontal" style="height:100%">

        		<div class="form-group col-md-12 form-horizontal"> 
                	<div class="col-md-4" style="text-align: center;">
                  		<img src="/storage/excel.png/" style="width:100px;height:100px;"  />
                    	<button type="button" class="btn btn-primary" style="position:absolute;top:50px;left:75px;" onclick="location.href='{{route('export_total')}}'">
                      		<i class="glyphicon glyphicon-stats"></i>
                        	下載
                    	</button>
                  		<label for="company_EIN" class="col-md-12 control-label" style="text-align:center;">總表匯出</label>
                	</div>  
                	
                	<div class="col-md-4" style="text-align: center;">
                  		<img src="/storage/excel.png/" style="width:100px;height:100px;"  /> 
                  		<button type="button" class="btn btn-primary" style="position:absolute;top:50px;left:75px;" onclick="location.href='{{route('export_total')}}'">
                      		<i class="glyphicon glyphicon-stats"></i>
                        	下載
                    	</button>
                  		<label for="company_EIN" class="col-md-12 control-label" style="text-align:center;">發版匯出</label>
                	</div>
                	
                	<div class="col-md-4" style="text-align: center;">
                  		<img src="/storage/excel.png/" style="width:100px;height:100px;"  />
                  		<label for="company_EIN" class="col-md-12 control-label" style="text-align:center;"></label>
                	</div>
              	</div>

              	<div class="form-group col-md-12 form-horizontal"> 
              	</div>
              	<div class="form-group col-md-12 form-horizontal"> 
              	</div>
              	<div class="form-group col-md-12 form-horizontal"> 
              	</div>

              	<div class="form-group col-md-12 form-horizontal"> 
                	<div class="col-md-4" style="text-align: center;">
                  		<img src="/storage/excel.png/" style="width:100px;height:100px;"  />
                  		
                  		<label for="company_EIN" class="col-md-12 control-label" style="text-align:center;"></label>
                	</div>  
                	
                	<div class="col-md-4" style="text-align: center;">
                  		<img src="/storage/excel.png/" style="width:100px;height:100px;"  /> 
                  		<label for="company_EIN" class="col-md-12 control-label" style="text-align:center;"></label>
                	</div>
                	
                	<div class="col-md-4" style="text-align: center;">
                  		<img src="/storage/excel.png/" style="width:100px;height:100px;"  />
                  		<label for="company_EIN" class="col-md-12 control-label" style="text-align:center;"></label>
                	</div>
              	</div>

			</div>
			</div>
		</div>
	</div>
</div>
@endsection

