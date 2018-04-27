@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">Permission資訊</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.user_center_block')
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
          permission
          </label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
          <div class="form-horizontal">
          <div class="form-group col-md-12 form-horizontal">

            <label for="server_name" class="col-md-2 control-label" style="text-align:right;">Permission:</label>
              <div class="col-md-4">
                <input type="text" name="server_name" class=" col-md-4 form-control" value="{{$data->name}}" readonly>
              </div>
            
            <label for="company_server_type" class="col-md-2 control-label" style="text-align:right;">DisplayName:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_type" class=" col-md-4 form-control" value="{{$data->display_name}}" readonly>
                
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="company_business_code" class="col-md-2 control-label" style="text-align:right;">Description:</label>
              <div class="col-md-4">
              <input type="text" name="company_business_code" class=" col-md-4 form-control ColorOrange"  value="{{$data->description}}" readonly required></div>

            <label for="company_version_num" class="col-md-2 control-label" style="text-align:right;">更新時間:</label>
            <div class="col-md-4">
              <input type="text" name="company_version_num" class="col-md-4 form-control ColorOrange" value="{{$data->updated_at}}" readonly required>                
            </div>


          </div>
          @foreach($pdata as $permission)
          <div class="form-group col-md-12 form-horizontal">

            <label for="company_business_code" class="col-md-2 control-label" style="text-align:right;">Permission:</label>
              <div class="col-md-4">
              <input type="text" name="company_business_code" class=" col-md-4 form-control ColorOrange"  value="{{$permission->display_name}}" readonly required></div>

            <label for="company_version_num" class="col-md-2 control-label" style="text-align:right;">描述:</label>
            <div class="col-md-4">
              <input type="text" name="company_version_num" class="col-md-4 form-control ColorOrange" value="{{$permission->description}}" readonly required>                
            </div>

          </div>
          @endforeach
          
          

          </div>
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                <script>//彈出對話框確認 
                  function Confirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                      window.location="{{URL::route('permission_delete', $data->id)}}";
                    else  
                      return false;
                  }   

                </script>
              <div class="col-md-2" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="return Confirm();">
                <i class="glyphicon glyphicon-trash"></i>
                刪除
                </button>
              </div>

              <div class="col-md-2 col-md-offset-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('permission_edit', $data->id)}}'">
                <i class="glyphicon glyphicon-pencil"></i>
                修改
                </button>
              </div>

              <div class="col-md-2 col-md-offset-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('permission_index')}}'">
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