@extends('layouts.master')

@section('title')
<h2 style="margin-top: 2px">匯出管理</h2>
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

          @if (Session::has('flash_message'))
            <div class="alert alert-success fade in" style="width:250px;position:absolute;right:350px;top:154px;text-align:center;z-index:99;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
              </button>
              {{ Session::get('flash_message') }}
            </div>
          @endif

        		<div class="form-group col-md-12 form-horizontal"> 
                	<div class="col-md-4" style="text-align: center;">
                  		<img src="/storage/excel.png/" style="width:100px;height:100px;"  />
                    	<button type="button" class="btn btn-primary" style="position:absolute;top:50px;left:75px;" onclick="location.href='{{route('export_total')}}'">
                      		<i class="glyphicon glyphicon-stats"></i>
                        	下載
                    	</button>
                  		<label for="company_EIN" class="col-md-12 control-label" style="text-align:center;">總表匯出</label>
                	</div>  
                	
                	<div class="col-md-8" style="text-align: center;">
                    @if($k!=null)
                    <input type="text" name="k_view" class=" col-md-4 form-control" value="{{$k->value}}" readonly style="width:450px;">
                    @endif

                  		<form class="form-horizontal" method="POST" action="{{ route('export_k') }}">
                        {{ csrf_field() }}
                      <input id="k" type="text" class="form-control" name="k" value="" placeholder="請輸入K值" required autofocus style="width:450px;">
                  		<button  type="submit" class="btn btn-primary" style="position:absolute;top:90px;left:200px;">
                      		<i class="glyphicon glyphicon-stats"></i>
                        	新增K值
                    	</button>
                  		
                      </form>
                	</div>

            </div>

              	<div class="form-group col-md-12 form-horizontal"> 
              	</div>
              	<div class="form-group col-md-12 form-horizontal"> 
              	</div>
              	<div class="form-group col-md-12 form-horizontal"> 
              	</div>

              	<form class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="return Confirm();" action="/export/upload_cloud" >
                {{ csrf_field() }}

        <div class="form-group col-md-12 form-horizontal">
            
            <label for="excel" class="col-md-2 control-label">上傳附件:</label>
            <div class="col-md-8">
            <input type="file" multiple class="form-control" id="excel" name='excel' placeholder="上傳excel" accept=".xlsx" value="Upload" required>
           
            </div>

            <button type="submit" class="btn btn-primary">
                產出發版資料
                </button>
        </div>
        </form>

			</div>
			</div>
		</div>
	</div>
</div>
@endsection

