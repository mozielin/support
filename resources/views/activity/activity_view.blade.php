@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">Log瀏覽</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.center_block')
</div>
<!--最外框-->
<div class="container" style="width:780px;height:100%;margin-right:218px;">
  <div class="panel panel-default">
<!--第一區塊-->
    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px">
    <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left;"> Log編號:{{$data->id}}
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
                    {{$data->log_name}}
          </label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->causer_id}}</label>
        </div>
        <!--區塊內容-->
          <div class="panel-body" style="height:100%">
            <div class="form-horizontal">

              <div class="form-group col-md-12 form-horizontal">
                <label for="bulletin_content" class="col-md-2 control-label" style="text-align:left;">Log內容:</label>   
              </div>

            <div class="form-group col-md-12 form-horizontal">
              <div class="col-md-12">
                <label for="createdby" class="col-md-6 control-label" style="text-align:center;">原始資料:</label>
                <label for="createdby" class="col-md-6 control-label" style="text-align:center;">異動資料:</label>
                <div class="col-md-6">
                @if($old != null)
                  @foreach($old as $okey => $odata)
                <p style="word-break:break-all;text-align:center;">{{$okey}}:{{$odata}}</p></pre>
                  @endforeach
                @endif
                </div>
                 
                <div class="col-md-6">
                @if($attributes != null)
                  @foreach($attributes as $akey => $adata)
                <p style="word-break:break-all;text-align:center;">{{$akey}}:{{$adata}}</p></pre>
                  @endforeach
                @endif
                </div>
              </div>
            </div>
          
              <div class="form-group col-md-12 form-horizontal">

                <label for="createdby" class="col-md-2 control-label" style="text-align:right;">異動資料:</label>
                <div class="col-md-4">
                  <input type="text" name="createdby" class=" col-md-6 form-control ColorOrange"  value="{{$data->description.'::'.$data->subject_id.'::'.$data->subject_type}}" readonly>        
                </div>

                <label for="created_at" class="col-md-2 control-label" style="text-align:right;">Create:</label>
                <div class="col-md-4">
                  <input type="textarea" name="created_at" class=" col-md-2 form-control ColorOrange"  value="{{$data->created_at}}" readonly>                
                </div>

              </div>
  
              <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                
                <div class="col-md-2" style="text-align:center;">
                 
                </div>

                <div class="col-md-2 col-md-offset-8" style="text-align:center;">
                  <button type="button" class="btn btn-primary" onclick="location.href='{{route('activity_index')}}'">
                  <i class="glyphicon glyphicon-backward"></i>
                  返回
                  </button>
                </div>
              </div> 
           
          </div><!--區塊內容結束-->
       
          </div>
      </div>
    </div><!--第一區塊結束-->
    </div>
  </div>     
@endsection