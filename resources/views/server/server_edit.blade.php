@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">修改主機資訊</h2>
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
          {{$data->company_name}}</label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->name}}</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">

        <script>//彈出對話框確認
          function Confirm()
          {
            if(confirm("確認修改此筆資料？")==true)   
              return true;
            else  
              return false;
          }   
        </script>
        <form class="form-horizontal" method="POST" onsubmit="return Confirm();" action="{{ route('server_update',$data->id) }}">

          {{ csrf_field() }}          

          <div class="form-group col-md-12 form-horizontal">

            <label for="plan_name" class="col-md-2 control-label" style="text-align:right;">主機名稱:</label>
              <div class="col-md-4">
                <input type="text" name="server_name" class=" col-md-4 form-control" style="width: 100%;text-align:center" value="{{$data->server_name}}" required autofocus>
              </div>
            
            <label for="company_server_type" class="col-md-2 control-label" style="text-align:right;">主機類型:</label> 
            <div class="col-md-4">
            <select name="company_server_type" class="form-control" style="width: 100%;text-align: center;padding-left:72px " required>
              @if($data->company_server_type == 'VoIP')
                //如果迴圈符合則預設選取
                <option style="" selected="true" value="VoIP">VoIP</option>
                <option style="text-align: center" value="Team+">Team+</option>
              @else
                //如果不符合就跑其他選項
                <option style="text-align: center" selected="true" value="Team+">Team+</option>
                <option style="text-align: center" value="VoIP">VoIP</option>
              @endif
            </select>                
            </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="company_business_code" class="col-md-2 control-label" style="text-align:right;">企業代碼:</label>
            <div class="col-md-4">
              <input type="text" name="company_business_code" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->company_business_code}}" >                
            </div>

            <label for="company_version_num" class="col-md-2 control-label" style="text-align:right;">安裝版號:</label>
            <div class="col-md-4">
              <input type="text" name="company_version_num" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->company_version_num}}" required>                
            </div>

          </div>
          
          <div class="form-group col-md-12 form-horizontal">

            <label for="company_server_interip" class="col-md-2 control-label" style="text-align:right;">主機內網IP:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_interip" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->company_server_interip}}">               
              </div>
            
            <label for="company_server_extip" class="col-md-2 control-label" style="text-align:right;">主機對外IP:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_extip" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->company_server_extip}}">           
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">
          
            <label for="company_server_mac" class="col-md-2 control-label" style="text-align:right;">主機MAC:</label>
              <div class="col-md-4">
                <input type="text" name="company_server_mac" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->company_server_mac}}" required>        
              </div>

            <label for="Updateby" class="col-md-2 control-label" style="text-align:right;">Updateby:</label>
              <div class="col-md-4">
                <input type="text" name="Updateby" class=" col-md-4 form-control ColorOrange" value="{{Auth::user()->name}}" readonly required>
                <input type="hidden" name="company_server_update" value="{{Auth::user()->id}}">                
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">
            <label for="company_version_num" class="col-md-2 control-label" style="text-align:right;"></label>
            <div class="col-md-4">
                           
            </div>

            <label for="build_type" class="col-md-2 control-label" style="text-align:right;">建置方式:</label>
            <div class="col-md-4">
              <select class="form-control" style="" name="build_type" id="build_type" required placeholder="請選擇建置方式" required>        
                @if($data->build_type == '自備伺服器')                        
                <option selected="true" value="自備伺服器">自備伺服器</option>
                <option value="私有雲代管">私有雲代管</option>
                @elseif($data->build_type == '私有雲代管')
                <option value="自備伺服器">自備伺服器</option>
                <option selected="true" value="私有雲代管">私有雲代管</option>
                @else
                <option value="私有雲代管">私有雲代管</option>
                <option value="自備伺服器">自備伺服器</option>
                @endif
              </select>               
            </div>
          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="URL" class="col-md-2 control-label" style="text-align:right;">站台位置:</label>
            <div class="col-md-10">
              <input type="text" name="URL" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->URL}}" >               
            </div>
                                
          </div>
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

            <div class="col-md-3" style="text-align:center;">
                <button type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-check"></i>
                確認修改
                </button>
            </div>

              <div class="col-md-3 col-md-offset-6" style="text-align:center;">
                  <button type="button" class="btn btn-primary" onclick="location.href='{{route('server_view', $data->id)}}'">
                  <i class="glyphicon glyphicon-pencil"></i>
                返回
                </button>
              </div>
                            
            </div>
          </form>
          </div><!--區塊內容結束-->
        </div>
      </div>
    </div><!--第一區塊結束-->
  </div>
@endsection