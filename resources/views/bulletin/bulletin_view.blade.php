@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">公告瀏覽</h2>
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
          <label for="id" class="col-md-3" style="text-align:left;"> 公告編號:{{$data->id}}
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
                    {{$data->bulletin_name}}
          </label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->name}}</label>
        </div>
        <!--區塊內容-->
          <div class="panel-body" style="height:100%">
            <div class="form-horizontal">

              <div class="form-group col-md-12 form-horizontal">
                <label for="bulletin_content" class="col-md-2 control-label" style="text-align:left;">公告內容:</label>   
              </div>

            <div class="form-group col-md-12 form-horizontal">
              <div class="col-md-12">
                <pre style="width:680px">{{$data->bulletin_content}}</pre>
              </div>
            </div>
          
              <div class="form-group col-md-12 form-horizontal">

                <label for="createdby" class="col-md-2 control-label" style="text-align:right;">Createby_:</label>
                <div class="col-md-4">
                  <input type="text" name="createdby" class=" col-md-4 form-control ColorOrange" value="{{$data->name}}" readonly>        
                </div>

                <label for="created_at" class="col-md-2 control-label" style="text-align:right;">Create:</label>
                <div class="col-md-4">
                  <input type="textarea" name="created_at" class=" col-md-4 form-control ColorOrange"  value="{{$data->created_at}}" readonly>                
                </div>

              </div>
  
              <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                <script>//彈出對話框確認 
                  function Confirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                      window.location="{{URL::route('bulletin_delete', $data->id)}}";
                    else  
                      return false;
                  }   

                </script>
                <div class="col-md-2" style="text-align:center;">
                  @permission('bulletin_delete')
                  <button type="button" class="btn btn-primary" onclick="return Confirm();">
                  <i class="glyphicon glyphicon-trash"></i>
                  刪除
                  </button>
                  @endpermission
                </div>

                <div class="col-md-2 col-md-offset-8" style="text-align:center;">
                  <button type="button" class="btn btn-primary" onclick="location.href='{{route('bulletin_index')}}'">
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