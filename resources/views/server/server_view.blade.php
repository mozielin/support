@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">主機資訊</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.center_block')
</div>
<div class="container" style="width:780px;height:100%;margin-right:218px;">
  <!--最外框-->
  <div class="panel panel-default">
    <!--第一區塊-->
    <div class="panel-heading" >
      <div class="panel panel-default" > 
        <div class="panel-heading" style="text-align:center; height:40px">
          <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left;">ID:
          {{$data->id}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
          <a href="{{route('company_view',$data->company_server)}}">
                    {{$data->company_name}}</a></label></label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->name}}</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
          <div class="form-horizontal">
          <div class="form-group col-md-12 form-horizontal">

            <label for="server_name" class="col-md-2 control-label" style="text-align:right;">主機名稱:</label>
              <div class="col-md-4">
                <input type="text" name="server_name" class=" col-md-4 form-control" value="{{$data->server_name}}" readonly>
              </div>
            
            <label for="company_server_type" class="col-md-2 control-label" style="text-align:right;">主機類型:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_type" class=" col-md-4 form-control" value="{{$data->company_server_type}}" readonly>
                
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="company_business_code" class="col-md-2 control-label" style="text-align:right;">企業代碼:</label>
              <div class="col-md-4">
              <input type="text" name="company_business_code" class=" col-md-4 form-control ColorOrange"  value="{{$data->company_business_code}}" readonly required></div>

            <label for="company_version_num" class="col-md-2 control-label" style="text-align:right;">安裝版號:</label>
            <div class="col-md-4">
              <input type="text" name="company_version_num" class="col-md-4 form-control ColorOrange" value="{{$data->company_version_num}}" readonly required>                
            </div>


          </div>
          
          <div class="form-group col-md-12 form-horizontal">

            <label for="company_server_interip" class="col-md-2 control-label" style="text-align:right;">主機內網IP:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_interip" class=" col-md-4 form-control ColorOrange" value="{{$data->company_server_interip}}" readonly required>               
              </div>
            
            <label for="company_server_extip" class="col-md-2 control-label" style="text-align:right;">主機對外IP:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_extip" class=" col-md-4 form-control ColorOrange" value="{{$data->company_server_extip}}" readonly required>           
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="company_server_mac" class="col-md-2 control-label" style="text-align:right;">主機MAC:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_mac" class=" col-md-4 form-control ColorOrange" value="{{$data->company_server_mac}}" readonly required>        
              </div>

            <label for="company_server_update" class="col-md-2 control-label" style="text-align:right;">Updateby:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_update" class=" col-md-4 form-control ColorOrange" value="{{$updateby}}" readonly required>                
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">
            <label for="company_version_num" class="col-md-2 control-label" style="text-align:right;">Sync版號:</label>
            <div class="col-md-4">
              <input type="text" name="company_version_num" class="col-md-4 form-control ColorOrange" value="{{$data->sync_ver}}" readonly required>                
            </div>

            <label for="sync_at" class="col-md-2 control-label" style="text-align:right;">SyncTime:</label>
            <div class="col-md-4">
              <input type="text" name="sync_at" class="col-md-4 form-control ColorOrange" value="{{$data->sync_at}}" readonly required>                
            </div>
          </div>

           <div class="form-group col-md-12 form-horizontal">
            <label for="company_version_num" class="col-md-2 control-label" style="text-align:right;"></label>
            <div class="col-md-4">
                           
            </div>

            <label for="build_type" class="col-md-2 control-label" style="text-align:right;">建置方式:</label>
            <div class="col-md-4">
              <input type="text" name="build_type" class="col-md-4 form-control ColorOrange" value="{{$data->build_type}}" readonly required>                
            </div>
          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="URL" class="col-md-2 control-label" style="text-align:right;">站台位置:</label>
            <div class="col-md-10">
              <input type="text" name="URL" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->URL}}" readonly>               
            </div>
                            
          </div>

          </div>
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                <script>//彈出對話框確認 
                  function Confirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                      window.location="{{URL::route('server_delete', $data->id)}}";
                    else  
                      return false;
                  }   

                </script>
              <div class="col-md-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="return Confirm();">
                <i class="glyphicon glyphicon-trash"></i>
                刪除
                </button>
              </div>


              <div class="col-md-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('function_view', $data->id)}}'">
                <i class="glyphicon glyphicon-cog"></i>
                功能
                </button>
              </div>

              <div class="col-md-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('server_edit', $data->id)}}'">
                <i class="glyphicon glyphicon-pencil"></i>
                修改
                </button>
              </div>

              <div class="col-md-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('server_index')}}'">
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